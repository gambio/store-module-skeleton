# store.json Reference

The `store.json` file defines the metadata for your module in the Gambio App Store. It must be located in the **project root** (not inside `src/`).

## Minimal Example

```json
{
    "name": "My Module",
    "code": "my_module",
    "type": "module",
    "title": {
        "en": "My Module",
        "de": "Mein Modul"
    },
    "vendor": {
        "name": "AcmeCorp",
        "url": "https://example.com/"
    },
    "requirements": {
        "needed": {
            "shop": { "shopVersions": [">=5.0.0.0"] },
            "server": { "phpVersions": [">=8.0"], "mysqlVersions": [">=5.5"] }
        }
    }
}
```

## Field Reference

### Top-Level Fields

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `name` | string | Yes | Internal package name |
| `code` | string | Yes | Unique module code (used internally) |
| `type` | string | Yes | Package type, always `"module"` |
| `title` | object | Yes | Display title with `en` and `de` keys |
| `description` | object | No | HTML description with `en` and `de` keys |
| `vendor` | object | Yes | Vendor information |
| `displayImage` | object | No | Preview image paths with `en` and `de` keys |
| `highlights` | array | No | Feature bullet points for the Store listing |
| `migrations` | object | No | Database migration scripts (not yet supported, see note below) |
| `requirements` | object | Yes | Version requirements |

### vendor

```json
{
    "vendor": {
        "name": "AcmeCorp",
        "url": "https://example.com/",
        "avatar": ""
    }
}
```

### highlights

Up to 3 short feature descriptions shown on the Store page:

```json
{
    "highlights": [
        { "title": { "en": "Easy to configure", "de": "Einfach zu konfigurieren" } },
        { "title": { "en": "Multi-language support", "de": "Mehrsprachig" } }
    ]
}
```

### migrations

!!! warning
    The `migrations` field with `up`/`down` is **not yet supported** by the Gambio Store system. It is reserved for future use.

To create database tables or run SQL during installation, use **lifecycle hooks** in your `GXModule.json` instead. Your install/uninstall PHP methods receive a database instance and can execute any SQL queries directly. See the [Module Development Guide](./module-development-guide.md#adding-lifecycle-hooks-optional) for a complete example.

**Planned format (not yet functional):**

```json
{
    "migrations": {
        "up": [
            "CREATE TABLE IF NOT EXISTS my_table (id INT PRIMARY KEY AUTO_INCREMENT)"
        ],
        "down": [
            "DROP TABLE IF EXISTS my_table"
        ]
    }
}
```

### requirements

```json
{
    "requirements": {
        "needed": {
            "shop": { "shopVersions": [">=5.0.0.0"] },
            "server": { "phpVersions": [">=8.0"], "mysqlVersions": [">=5.5"] },
            "themes": [],
            "receiptFiles": []
        },
        "hidden": {
            "shop": { "shopVersions": [] },
            "server": { "phpVersions": [], "mysqlVersions": [] },
            "themes": []
        }
    }
}
```

- **needed**: Requirements that must be met for the module to be installable
- **hidden**: Versions where the module is hidden from the Store (not shown at all)
- **shopVersions**: Gambio shop version constraints (e.g. `>=5.0.0.0`, `<=5.5.0.0`)
- **phpVersions**: PHP version constraints
- **mysqlVersions**: MySQL version constraints
- **themes**: Required themes (leave empty for theme-independent modules)
- **receiptFiles**: Require other Gambio modules to be installed (matched against files in `version_info/`)

### Example: Depending on another Gambio module

If your module depends on another Gambio module being installed, use `receiptFiles`. The Store system checks the shop's `version_info/` directory for the specified filenames:

```json
{
    "requirements": {
        "needed": {
            "shop": { "shopVersions": [">=5.0.0.0"] },
            "server": { "phpVersions": [">=8.0"], "mysqlVersions": [">=5.5"] },
            "themes": [],
            "receiptFiles": ["some_required_module.php"]
        }
    }
}
```

If the required module is not installed on the target shop, your module cannot be installed and the customer sees a message about the missing dependency.

!!! info "version_info files are added by the Gambio team"

    The files in `version_info/` are automatically generated during the module onboarding process by the Gambio team. You do not need to create them yourself. See the [Publishing Guide](./publishing-guide.md#version-info-file) for details.

## Description Images

You can embed images in the Store description HTML. Place image files in `.assets/` and reference them using bracket notation:

```html
<img src="[screenshot.png]" class="img-fluid w-100">
```

The `[screenshot.png]` placeholder is replaced by the Store system with the actual hosted URL.

## Overriding Descriptions with HTML Files

Instead of putting HTML in `store.json`, you can create separate files:

```
.assets/de/description.html
.assets/en/description.html
```

When these files exist, they override the `description` field in `store.json`.

## Next Steps

- [Module Development Guide](./module-development-guide.md): How to build your module
- [Publishing Guide](./publishing-guide.md): How to submit to the Store
