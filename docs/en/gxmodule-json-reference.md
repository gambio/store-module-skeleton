# GXModule.json Reference

The `GXModule.json` file is the central manifest for every Gambio module. It registers the module in the Module Center and can auto-generate a configuration page without any HTML or controllers.

## Location

```
src/GXModules/{Vendor}/{Module}/GXModule.json
```

## Minimal Example

```json
{
    "title": "my_module.PAGE_TITLE",
    "description": "my_module.DESCRIPTION"
}
```

This is enough to make the module appear in the Module Center.

## Full Schema

| Key | Type | Description |
|-----|------|-------------|
| `title` | string | Translation key for the module title |
| `description` | string | Translation key for the module description |
| `sortOrder` | number | Position in the Module Center list (default: 0) |
| `forceIncludingFiles` | boolean | Force-load module files even when not installed (default: false) |
| `config_url` | string | Custom URL for the configuration page (overrides auto-generated page) |
| `install` | object | *(Optional)* PHP hook called on module installation |
| `uninstall` | object | *(Optional)* PHP hook called on module uninstallation |
| `save` | object | *(Optional)* PHP hook called after configuration is saved |
| `configuration` | array | Configuration sections with form fields |

## Lifecycle Hooks (Optional)

!!! note
    Lifecycle hooks are **completely optional**. If your module only needs a simple configuration page, you do not need to define `install`, `uninstall`, or `save` hooks. Gambio stores and reads configuration values automatically. Only add hooks if your module needs custom logic (e.g. creating database tables, clearing caches, or validating input).

### install / uninstall

```json
{
    "install": {
        "controller": "GXModules\\AcmeCorp\\MyModule\\Admin\\Actions\\InstallAction",
        "method": "onInstall"
    },
    "uninstall": {
        "controller": "GXModules\\AcmeCorp\\MyModule\\Admin\\Actions\\InstallAction",
        "method": "onUninstall"
    }
}
```

**Resolution order:**
1. The class is first looked up in the DI container (if registered via ServiceProvider)
2. Fallback: resolved via MainFactory

**Method signature (DI container):**

When the class is resolved via the DI container, the method receives only the parsed GXModule.json data:

```php
public function onInstall(array $gxModulesJsonData): void
```

**Method signature (MainFactory fallback):**

When the class is resolved via MainFactory, the method receives four parameters:

```php
public function onInstall($db, array $moduleData, $languageTextManager, $cacheControl): void
```

- `$db`: CI_DB_query_builder database instance
- `$moduleData`: Parsed GXModule.json content as array
- `$languageTextManager`: LanguageTextManager for translations
- `$cacheControl`: DataCache for cache clearing

If no `uninstall` hook is defined, all configuration values are automatically deleted on uninstall.

!!! info
    Gambio does not have an automatic database migration system. If your module needs custom tables, create them in the `install` hook and drop them in the `uninstall` hook using SQL queries. See the [Module Development Guide](./module-development-guide.md#example-creating-database-tables-in-lifecycle-hooks) for a complete example with both MainFactory and DI container variants.

### save

```json
{
    "save": {
        "controller": "GXModules\\AcmeCorp\\MyModule\\Admin\\Actions\\SaveAction",
        "method": "onSave"
    }
}
```

**Method signature:**
```php
public function onSave($db, $configurationStorage, $languageTextManager, $cacheControl): void
```

- `$configurationStorage`: GXModuleConfigurationStorage for reading saved values

## Configuration Sections

The `configuration` array defines sections of form fields. Each section has a title and a set of fields:

```json
{
    "configuration": [
        {
            "title": "my_module.SECTION_GENERAL",
            "fields": {
                "fieldKey": {
                    "type": "text",
                    "label": "my_module.LABEL_FIELD"
                }
            }
        }
    ]
}
```

### Section Properties

| Key | Type | Description |
|-----|------|-------------|
| `title` | string | Translation key for the section heading |
| `tab` | string | Translation key for a tab name (groups sections into tabs) |
| `fields` | object | Key-value map of field definitions |

### Tabs

Use the `tab` property to group multiple sections under tabs:

```json
{
    "configuration": [
        {
            "title": "my_module.SECTION_BASIC",
            "fields": { }
        },
        {
            "title": "my_module.SECTION_ADVANCED",
            "tab": "my_module.TAB_ADVANCED",
            "fields": { }
        },
        {
            "title": "my_module.SECTION_ACTIONS",
            "tab": "my_module.TAB_ADVANCED",
            "fields": { }
        }
    ]
}
```

Sections without a `tab` appear on the default (first) tab. Sections with the same `tab` value are grouped together.

## Field Types

### checkbox

A boolean toggle.

```json
{
    "type": "checkbox",
    "label": "my_module.LABEL_ENABLE"
}
```

### text

Single-line text input.

```json
{
    "type": "text",
    "label": "my_module.LABEL_NAME",
    "required": true
}
```

### password

Password input (masked).

```json
{
    "type": "password",
    "label": "my_module.LABEL_SECRET"
}
```

### email

Email input with browser validation.

```json
{
    "type": "email",
    "label": "my_module.LABEL_EMAIL"
}
```

### number

Numeric input with optional range and step.

```json
{
    "type": "number",
    "label": "my_module.LABEL_QUANTITY",
    "default_value": "10",
    "min": 1,
    "max": 100,
    "step": 1
}
```

### color

Color picker.

```json
{
    "type": "color",
    "label": "my_module.LABEL_COLOR",
    "default_value": "#002337"
}
```

### date

Date picker (date only).

```json
{
    "type": "date",
    "label": "my_module.LABEL_START_DATE"
}
```

### datetime

Date and time picker.

```json
{
    "type": "datetime",
    "label": "my_module.LABEL_SCHEDULE"
}
```

### file

File upload field.

```json
{
    "type": "file",
    "label": "my_module.LABEL_LOGO",
    "folder": "images/modules",
    "accept": "image/*"
}
```

- `folder`: Upload destination relative to the shop root
- `accept`: MIME type filter for the file picker

### textarea

Multi-line text input.

```json
{
    "type": "textarea",
    "label": "my_module.LABEL_NOTES"
}
```

### editor

Rich text editor (WYSIWYG).

```json
{
    "type": "editor",
    "label": "my_module.LABEL_CONTENT",
    "languageDependent": true
}
```

When `languageDependent` is `true`, a separate input tab is rendered for each shop language.

### select

Dropdown with predefined options.

```json
{
    "type": "select",
    "label": "my_module.LABEL_MODE",
    "values": [
        { "value": "grid", "text": "my_module.OPTION_GRID" },
        { "value": "list", "text": "my_module.OPTION_LIST" }
    ]
}
```

### multiselect

Multiple-choice selection.

```json
{
    "type": "multiselect",
    "label": "my_module.LABEL_OPTIONS",
    "values": [
        { "value": "a", "text": "Option A" },
        { "value": "b", "text": "Option B" },
        { "value": "c", "text": "Option C" }
    ],
    "selected": ["a", "b"]
}
```

### customer_group

Dropdown pre-populated with the shop's customer groups.

```json
{
    "type": "customer_group",
    "label": "my_module.LABEL_CUSTOMER_GROUP"
}
```

### order_status

Dropdown pre-populated with the shop's order statuses.

```json
{
    "type": "order_status",
    "label": "my_module.LABEL_STATUS"
}
```

### countries

Dropdown pre-populated with the shop's country list.

```json
{
    "type": "countries",
    "label": "my_module.LABEL_COUNTRIES"
}
```

### languages

Dropdown pre-populated with the shop's active languages.

```json
{
    "type": "languages",
    "label": "my_module.LABEL_LANGUAGE"
}
```

### button

An action button that triggers an AJAX call.

```json
{
    "type": "button",
    "label": "my_module.LABEL_SYNC",
    "text": "my_module.BTN_SYNC_NOW",
    "color": "primary",
    "action": {
        "controller": "GXModules\\AcmeCorp\\MyModule\\Admin\\Actions\\SyncAction",
        "method": "sync",
        "message": "my_module.MSG_SYNC_DONE"
    }
}
```

- `color`: Button color: `default`, `primary`, `success`, `info`, `warning`, `danger`, `link`
- `action.controller`: PHP class to call (must extend `GXModuleController`)
- `action.method`: Method name to invoke
- `action.message`: Translation key for the success message

A button can also trigger a modal instead of a direct action:

```json
{
    "type": "button",
    "label": "my_module.LABEL_RESET",
    "text": "my_module.BTN_RESET",
    "color": "danger",
    "modal": "resetModal"
}
```

The `modal` value must match a field key of type `modal` in the same section.

### modal

A confirmation dialog triggered by a button. Use `description` for simple text or `content` for custom HTML.

**Modal with text:**

```json
{
    "type": "modal",
    "title": "my_module.MODAL_TITLE",
    "description": "my_module.MODAL_TEXT",
    "buttons": {
        "cancel": {
            "text": "my_module.BTN_CANCEL"
        },
        "confirm": {
            "text": "my_module.BTN_CONFIRM",
            "action": {
                "controller": "GXModules\\AcmeCorp\\MyModule\\Admin\\Actions\\ResetAction",
                "method": "reset",
                "message": "my_module.MSG_RESET_DONE"
            }
        }
    }
}
```

**Modal with rendered HTML:**

```json
{
    "type": "modal",
    "title": "my_module.MODAL_TITLE",
    "content": "AcmeCorp/MyModule/Admin/Html/modal_content.html",
    "buttons": {
        "close": { "text": "buttons.cancel" },
        "confirm": {
            "text": "my_module.BTN_CONFIRM",
            "action": {
                "controller": "GXModules\\AcmeCorp\\MyModule\\Admin\\Actions\\SomeAction",
                "method": "execute",
                "message": "my_module.MSG_DONE"
            }
        }
    }
}
```

The `content` attribute references an HTML file relative to the GXModules directory that will be rendered inside the modal.
```

## Common Field Properties

These properties can be added to most field types:

| Property | Type | Description |
|----------|------|-------------|
| `label` | string | Translation key for the field label |
| `required` | boolean | Makes the field required |
| `default_value` | string | Default value for the field |
| `readonly` | boolean | Makes the field read-only (for text, email, number, date, datetime, textarea, editor) |
| `regex` | string | Validation pattern the input value must match (for text, password, email, number) |
| `selected` | array | Default selected values for multiselect fields |
| `languageDependent` | boolean | Render per-language input tabs (works with text-based field types, not just editor) |
| `tooltip` | object | Add an info or error tooltip |

### Tooltips

```json
{
    "tooltip": {
        "type": "info",
        "text": "my_module.TOOLTIP_HELP"
    }
}
```

- `type`: `info` (blue) or `error` (red)
- `text`: Translation key for the tooltip text

## Reading Configuration Values

To read saved configuration values in PHP, use the `GXModuleConfigurationStorage`:

```php
$configurationStorage = MainFactory::create('GXModuleConfigurationStorage', 'AcmeCorp/MyModule');
$isActive = $configurationStorage->get('enableFeature');
$apiKey = $configurationStorage->get('apiKey');
```

The second argument to `MainFactory::create` is `{Vendor}/{Module}`.

!!! note
    If no configuration has been saved yet, `GXModuleConfigurationStorage` returns the `default_value` from the `GXModule.json`.

### Return types per field type

| Type | Return value |
|------|-------------|
| `checkbox` | string: `"1"` for true, `"0"` for false |
| `text`, `password`, `email`, `number`, `color`, `date`, `datetime`, `textarea`, `editor` | string |
| `file` | string: file path relative to shop root |
| `select`, `customer_group`, `order_status`, `countries`, `languages` | string |
| `multiselect` | array |

## Complete Example

See the skeleton's `GXModule.json` for a working example that demonstrates all field types, tabs, tooltips, buttons, modals, and lifecycle hooks.
