# Gambio Store Module Skeleton: Documentation

This branch contains the developer documentation for the [Gambio Store Module Skeleton](https://github.com/gambio/store-module-skeleton).

For the module skeleton code, switch to the [`develop`](https://github.com/gambio/store-module-skeleton/tree/develop) branch.

Published at: **https://gambio.github.io/store-module-skeleton/**

## Documentation

### English

| Document | Description |
|----------|-------------|
| [Module Development Guide](docs/en/module-development-guide.md) | Step-by-step tutorial for building a module |
| [GXModule.json Reference](docs/en/gxmodule-json-reference.md) | All 18 configuration field types, hooks, tabs, buttons, modals |
| [store.json Reference](docs/en/store-json-reference.md) | Store package metadata format |
| [Local Testing](docs/en/local-testing.md) | Installing and testing modules locally |
| [Publishing Guide](docs/en/publishing-guide.md) | Submitting modules to the Gambio Store |
| [Release Checklist](docs/en/release-checklist.md) | Pre-release verification checklist |
| [Smarty Blocks Reference](docs/en/smarty-blocks-reference.md) | All 3,121 overridable Smarty blocks in the Malibu theme |

### Deutsch

| Dokument | Beschreibung |
|----------|--------------|
| [Modulentwicklung Anleitung](docs/de/modulentwicklung-anleitung.md) | Schritt-für-Schritt-Tutorial zur Modulerstellung |
| [GXModule.json Referenz](docs/de/gxmodule-json-referenz.md) | Alle 18 Konfigurationsfeldtypen, Hooks, Tabs, Buttons, Modals |
| [store.json Referenz](docs/de/store-json-referenz.md) | Store-Paket-Metadaten-Format |
| [Lokal testen](docs/de/lokal-testen.md) | Module lokal installieren und testen |
| [Veröffentlichung](docs/de/veroeffentlichung-guide.md) | Module im Gambio Store einreichen |
| [Release Checkliste](docs/de/release-checkliste.md) | Checkliste vor der Veröffentlichung |
| [Smarty Blocks Referenz](docs/de/smarty-blocks-referenz.md) | Alle 3.121 überschreibbare Smarty Blocks im Malibu Theme |

## Developer Registration

Developer registration is currently handled manually. To get started, send an email to **info@gambio.de** with the link to your GitHub repository.

A self-service Developer Portal is coming soon.

## Local Preview

To preview the documentation locally:

```bash
pip install mkdocs-material

# English (default)
mkdocs serve

# German
mkdocs serve --config-file mkdocs.de.yml
```

Then open http://127.0.0.1:8000 in your browser.

The site uses two separate MkDocs configurations (`mkdocs.yml` for English, `mkdocs.de.yml` for German) connected by a language switcher in the header. The GitHub Actions workflow builds both and deploys English at `/` and German at `/de/`.
