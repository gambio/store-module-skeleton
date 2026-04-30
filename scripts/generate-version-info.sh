#!/usr/bin/env bash
#
# Generates the version_info receipt for a Gambio store module at release
# time. Writes the receipt to two locations during the AB#729 transition:
#
#   - src/GXModules/<Vendor>/<Module>/version_info.php  (new convention)
#   - src/version_info/<code>-v<version>.php            (legacy fallback)
#
# The legacy directory is cleaned of older <code>-v*.php files first, so
# that only the current release ships in the archive.
#
# `id` and `version_id` are intentionally not written here. The Gambio
# Store API populates them during module onboarding.
#
# Usage: scripts/generate-version-info.sh <VERSION>
#   VERSION may be passed with or without a leading 'v'.

set -euo pipefail

if [[ $# -lt 1 ]]; then
  echo "Usage: $0 <VERSION>" >&2
  exit 1
fi

VERSION="${1#v}"
DATE="$(date -u +"%Y-%m-%d %H:%M")"

REPO_ROOT="$(cd "$(dirname "$0")/.." && pwd)"

if [[ ! -f "${REPO_ROOT}/store.json" ]]; then
  echo "store.json not found at ${REPO_ROOT}/store.json" >&2
  exit 1
fi

CODE="$(jq -r '.code' "${REPO_ROOT}/store.json")"
if [[ -z "${CODE}" || "${CODE}" == "null" ]]; then
  echo "Could not read 'code' from store.json" >&2
  exit 1
fi
CODE_LOWER="$(echo "${CODE}" | tr '[:upper:]' '[:lower:]')"

mapfile -t MODULE_DIRS < <(find "${REPO_ROOT}/src/GXModules" -mindepth 2 -maxdepth 2 -type d 2>/dev/null)
if [[ "${#MODULE_DIRS[@]}" -eq 0 ]]; then
  echo "No module directory found under src/GXModules/<Vendor>/<Module>/" >&2
  exit 1
fi
if [[ "${#MODULE_DIRS[@]}" -gt 1 ]]; then
  echo "Expected exactly one module directory under src/GXModules/<Vendor>/<Module>/, found ${#MODULE_DIRS[@]}:" >&2
  printf '  %s\n' "${MODULE_DIRS[@]}" >&2
  exit 1
fi
MODULE_DIR="${MODULE_DIRS[0]}"

LEGACY_DIR="${REPO_ROOT}/src/version_info"
mkdir -p "${LEGACY_DIR}"

rm -f "${LEGACY_DIR}/${CODE_LOWER}"-v*.php
rm -f "${MODULE_DIR}/version_info.php"

CONTENT="<?php die(''); ?>
version: v${VERSION}
date: ${DATE}
"

printf '%s' "${CONTENT}" > "${MODULE_DIR}/version_info.php"
printf '%s' "${CONTENT}" > "${LEGACY_DIR}/${CODE_LOWER}-v${VERSION}.php"

echo "Generated version_info for ${CODE} v${VERSION} at ${DATE} UTC"
echo "  - ${MODULE_DIR}/version_info.php"
echo "  - ${LEGACY_DIR}/${CODE_LOWER}-v${VERSION}.php"
