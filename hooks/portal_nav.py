"""MkDocs hook: render the developers.gambio.de tab bar from the portal's menu.

The portal (gambio/gambio.github.io) publishes its top-level `nav:` as
https://developers.gambio.de/assets/portal-nav.json on every deploy. This hook loads
that file at build time and exposes it as `config.extra.portal_tabs`; the
`{% block tabs %}` in html/main.html renders it, so nothing about the menu is
hard-coded in this repository. `extra.portal_tab_active` (mkdocs.yml) names the key
of this site's own tab.

Sources, first valid one wins:
  1. $PORTAL_NAV_FILE       local JSON file (used by the portal's full-site preview)
  2. $PORTAL_NAV_URL        defaults to the live portal file; PORTAL_NAV_OFFLINE=1 skips it
  3. hooks/portal-nav.json  committed snapshot - the offline / outage fallback

Refresh the snapshot with:  python hooks/portal_nav.py --sync
This file is identical in gambio/manual, gambio/docs and gambio/store-module-skeleton.
"""

import json
import logging
import os
import sys
import urllib.request
from pathlib import Path

log = logging.getLogger("mkdocs.hooks.portal_nav")

DEFAULT_URL = "https://developers.gambio.de/assets/portal-nav.json"
SNAPSHOT = Path(__file__).with_name("portal-nav.json")
LANGUAGES = ("de", "en")


def _validate(data):
    for lang in LANGUAGES:
        tabs = data.get(lang)
        if not isinstance(tabs, list) or not tabs:
            raise ValueError(f"no '{lang}' tabs")
        for tab in tabs:
            if not isinstance(tab, dict) or not {"key", "title", "url"} <= tab.keys():
                raise ValueError(f"malformed tab {tab!r}")
    return data


def _read_file(path):
    return _validate(json.loads(Path(path).read_text(encoding="utf-8")))


def _download(url):
    with urllib.request.urlopen(url, timeout=10) as resp:
        return _validate(json.loads(resp.read().decode("utf-8")))


def _warn_if_snapshot_outdated(live):
    try:
        outdated = _read_file(SNAPSHOT) != live
    except Exception as exc:  # missing or broken snapshot
        outdated, exc_text = True, f" ({exc})"
    else:
        exc_text = ""
    if outdated:
        log.warning(
            "portal_nav: snapshot %s differs from the live portal menu%s - run `python %s --sync`",
            SNAPSHOT.name, exc_text, Path(__file__).name,
        )


def _load():
    """Return (data, source) using the first valid source."""
    local = os.environ.get("PORTAL_NAV_FILE")
    if local:
        return _read_file(local), local
    url = os.environ.get("PORTAL_NAV_URL", DEFAULT_URL)
    if os.environ.get("PORTAL_NAV_OFFLINE") != "1":
        try:
            data = _download(url)
        except Exception as exc:  # offline, DNS, HTTP error, invalid JSON ...
            log.warning("portal_nav: %s unavailable (%s) - using snapshot %s", url, exc, SNAPSHOT.name)
        else:
            _warn_if_snapshot_outdated(data)
            return data, url
    return _read_file(SNAPSHOT), str(SNAPSHOT)


def on_config(config):
    data, source = _load()
    log.info("portal_nav: tabs loaded from %s", source)
    config.extra["portal_tabs"] = data
    return config


if __name__ == "__main__":
    if sys.argv[1:] != ["--sync"]:
        sys.exit(f"usage: {sys.argv[0]} --sync")
    source = os.environ.get("PORTAL_NAV_URL", DEFAULT_URL)
    SNAPSHOT.write_text(json.dumps(_download(source), ensure_ascii=False, indent=2) + "\n", encoding="utf-8")
    print(f"{SNAPSHOT}: updated from {source}")
