# Gambio Module Skeleton: Documentation

This branch contains the developer documentation for the [Gambio Module Skeleton](https://github.com/gambio/store-module-skeleton).

For the module skeleton code, switch to the [`develop`](https://github.com/gambio/store-module-skeleton/tree/develop) branch.

Published at: **https://gambio.github.io/store-module-skeleton/**

## Documentation

### English

| Document | Description |
|----------|-------------|
| [Module Development Guide](docs/en/module-development-guide.md) | Step-by-step tutorial for building a module |
| [GXModule.json Reference](docs/en/gxmodule-json-reference.md) | All 18 configuration field types, hooks, tabs, buttons, modals |
| [Local Testing](docs/en/local-testing.md) | Installing and testing modules locally |
| [Smarty Blocks Reference](docs/en/smarty-blocks-reference.md) | All 3,121 overridable Smarty blocks in the Malibu theme |

### Deutsch

| Dokument | Beschreibung |
|----------|--------------|
| [Modulentwicklung Anleitung](docs/de/modulentwicklung-anleitung.md) | Schritt-für-Schritt-Tutorial zur Modulerstellung |
| [GXModule.json Referenz](docs/de/gxmodule-json-referenz.md) | Alle 18 Konfigurationsfeldtypen, Hooks, Tabs, Buttons, Modals |
| [Lokal testen](docs/de/lokal-testen.md) | Module lokal installieren und testen |
| [Smarty Blocks Referenz](docs/de/smarty-blocks-referenz.md) | Alle 3.121 überschreibbare Smarty Blocks im Malibu Theme |

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
