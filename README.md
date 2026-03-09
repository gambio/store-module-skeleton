# Store Module Skeleton

A comprehensive skeleton project for building Gambio GX5 modules that are ready for the [Gambio App Store](https://store.gambio.com/).

This skeleton demonstrates **all major extension points** available to third-party module developers, including declarative configuration, event handling, HTTP routing, middleware, overloads, cronjobs, and theme extensions.

## Quick Start

1. **Fork or clone** this repository
2. **Rename** the vendor directory `XYZ` to your vendor name (e.g. `src/GXModules/AcmeCorp/YourModule/`)
3. **Update** the `XYZ` namespace placeholder in all PHP files to match (e.g. `GXModules\AcmeCorp\YourModule`)
4. **Update** `store.json` with your module information
5. **Implement** your module logic using the patterns demonstrated in the skeleton files
6. **Package** and submit to the Gambio Store

> **Important:** `XYZ` is used as a placeholder throughout the entire skeleton — both as the directory name (`src/GXModules/XYZ/`) and as the PHP namespace (`GXModules\XYZ\Skeleton`). You **must** replace it with your own vendor name before publishing.

## File Structure

```
store-module-skeleton/
├── .assets/                                  Gambio Store assets
│   ├── vendor_logo(.png|.jpg|.svg)            Vendor logo for Store listing
│   ├── module_logo(.png|.jpg|.svg)            Module logo for Store listing
│   ├── de/description.html                    German Store description (overrides store.json)
│   └── en/description.html                    English Store description (overrides store.json)
├── src/GXModules/XYZ/StoreModuleSkeleton/
│   ├── GXModule.json                         ★ Module Center integration + configuration UI
│   ├── SkeletonServiceProvider.php           ★ Dependency injection + event listeners
│   ├── SkeletonModule.php                    ★ Events, middleware, module dependencies
│   ├── routes.php                            ★ HTTP route registration (FastRoute)
│   ├── Admin/
│   │   ├── Actions/
│   │   │   ├── SkeletonInstallAction.php      Install/uninstall lifecycle hooks
│   │   │   ├── SkeletonSaveAction.php         After-save configuration hook
│   │   │   └── SkeletonCacheAction.php        Button action handler (AJAX)
│   │   ├── CronjobConfiguration/
│   │   │   ├── SkeletonCronjob.json           Cronjob config (interval, active state)
│   │   │   ├── SkeletonCronjobTask.inc.php    Cronjob execution logic
│   │   │   ├── SkeletonCronjobDependencies.inc.php  Cronjob DI dependencies
│   │   │   └── SkeletonCronjobLogger.inc.php  Cronjob logging
│   │   ├── Menu/
│   │   │   └── skeleton.menu.json             Admin menu entry (JSON format)
│   │   ├── Overloads/
│   │   │   └── OrderExtenderComponent/
│   │   │       └── SkeletonOrderExtender.inc.php  Admin order page overload
│   │   └── TextPhrases/
│   │       ├── german/
│   │       │   ├── skeleton_module.lang.inc.php    German module translations
│   │       │   └── cronjob_skeleton.lang.inc.php   German cronjob translations
│   │       └── english/
│   │           ├── skeleton_module.lang.inc.php    English module translations
│   │           └── cronjob_skeleton.lang.inc.php   English cronjob translations
│   ├── Shop/
│   │   ├── Overloads/
│   │   │   └── ApplicationTopExtenderComponent/
│   │   │       └── SkeletonApplicationTopExtender.inc.php  Storefront overload
│   │   └── Themes/All/
│   │       ├── Css/skeleton.css                Storefront CSS (loaded on all themes)
│   │       └── Javascript/product_info/skeleton.js  JS for product detail pages
│   └── App/                                   Application-level code (services, etc.)
├── composer.json                              Optional: Composer dependencies
├── store.json                                 Gambio Store package manifest
├── package.json                               npm/semantic-release config
└── README.md                                  This file
```

## Extension Points

### 1. GXModule.json — Module Center Configuration

The `GXModule.json` file is the central manifest that integrates your module into the Gambio Module Center. It replaces the deprecated `ModuleCenterModuleController` pattern entirely.

**What it provides:**
- Automatic registration in Module Center (no controller needed)
- Auto-generated configuration page with form fields
- Install/uninstall lifecycle hooks
- After-save hook for configuration changes
- Button actions with AJAX callbacks and confirmation modals

**Available field types (18):**
`checkbox`, `text`, `password`, `email`, `number`, `color`, `date`, `datetime`, `file`, `textarea`, `editor`, `select`, `multiselect`, `customer_group`, `order_status`, `countries`, `languages`, `button`, `modal`

**Key features:**
- `tab` — Groups configuration sections into tabs
- `languageDependent: true` — Renders per-language input tabs for a field
- `tooltip` — Adds info/warning tooltips to fields
- `required` — Marks fields as required
- `default_value` — Sets field defaults
- `button` + `modal` — Creates interactive buttons with AJAX actions and confirmation dialogs

See the skeleton's `GXModule.json` for a complete example covering all field types and features.

### 2. ServiceProvider — Dependency Injection

`SkeletonServiceProvider.php` extends `AbstractModuleBootableServiceProvider` and provides:

- **`provides()`** — Declares which services this provider can register
- **`register()`** — Registers services in the DI container (`registerShared()` for singletons, `register()` for transient)
- **`boot()`** — Runs after ALL providers are registered; use for event listener attachment and inflections

For simple modules without `boot()`, extend `AbstractModuleServiceProvider` instead.

### 3. Module Class — Events, Middleware, Dependencies

`SkeletonModule.php` extends `AbstractModule` and is auto-detected when named `*Module.php` at the module root. It provides a declarative alternative (or complement) to the ServiceProvider:

- **`eventListeners()`** — Register PSR-14 event listeners as `[EventClass => [ListenerClass, ...]]`
- **`shopMiddleware()`** — PSR-15 middleware for storefront requests
- **`adminMiddleware()`** — PSR-15 middleware for admin requests
- **`apiMiddleware()`** — PSR-15 middleware for REST API v3 requests
- **`dependsOn()`** — Declare dependencies on other GXModules

### 4. Routes — HTTP Routing

`routes.php` is auto-detected and uses FastRoute's `RouteCollector`:

```php
return static function (RouteCollector $routeCollector) {
    $routeCollector->get('/admin/skeleton', OverviewAction::class);
    $routeCollector->group('/admin/api/skeleton', function (RouteCollector $group) {
        $group->get('', FetchAllAction::class);
        $group->post('', CreateAction::class);
    });
};
```

Handler classes must implement PSR-15 `RequestHandlerInterface`. Register them in the ServiceProvider.

### 5. Admin Menu

`Admin/Menu/skeleton.menu.json` registers entries in the admin sidebar. This replaces the deprecated XML format (`menu_*.xml`).

```json
[{
    "id": "BOX_HEADING_SKELETON_MODULE",
    "sort": 400,
    "class": "fa fa-puzzle-piece",
    "title": "skeleton_module.BOX_SKELETON_MODULE",
    "type": "standalone",
    "items": [{
        "sort": 10,
        "link": "admin.php?do=SkeletonModule",
        "title": "skeleton_module.BOX_SKELETON_MODULE"
    }]
}]
```

### 6. Overloads — Extend Existing Classes

Overloads extend any class managed by `MainFactory` using the decorator chain pattern.

**Placement:**
- Admin overloads: `Admin/Overloads/{ClassName}/{YourFile}.inc.php`
- Shop overloads: `Shop/Overloads/{ClassName}/{YourFile}.inc.php`

**Rules:**
1. Your class must extend `{ClassName}_parent` (pseudo-class resolved by MainFactory)
2. Always call `parent::proceed()` (or the relevant parent method) to preserve the chain
3. The file must use `.inc.php` extension

**Common admin overloads:**
- `OrderExtenderComponent` — Add tabs/data to order detail page
- `AdminApplicationTopExtenderComponent` — Run code on every admin page
- `AdminEditProductExtenderComponent` — Extend product editing
- `PDFOrderExtenderComponent` — Extend PDF invoice generation

**Common shop overloads:**
- `ApplicationTopExtenderComponent` — Run code on every storefront page
- `ApplicationBottomExtenderComponent` — Post-rendering logic
- `HeaderExtenderComponent` — Inject into HTML header
- `CheckoutSuccessExtenderComponent` — Extend checkout success page

### 7. Cronjobs

Register scheduled tasks with 4 companion files in `Admin/CronjobConfiguration/`:

| File | Purpose |
|------|---------|
| `SkeletonCronjob.json` | Configuration (interval, active state, sort order) |
| `SkeletonCronjobTask.inc.php` | Main execution logic (`run()` method) |
| `SkeletonCronjobDependencies.inc.php` | Dependency injection for the task |
| `SkeletonCronjobLogger.inc.php` | Log handling (usually default is sufficient) |

The JSON file uses the `cronjob_skeleton` text section for UI translations.

### 8. Theme Overrides — Storefront CSS & JavaScript

Add CSS and JavaScript files to the storefront by placing them in `Shop/Themes/`:

```
Shop/Themes/All/Css/skeleton.css               → Loaded on ALL themes
Shop/Themes/All/Javascript/product_info/skeleton.js → Loaded on product detail page

Shop/Themes/Malibu/Css/skeleton.css             → Loaded only on Malibu theme
Shop/Themes/Honeygrid/Javascript/index/skeleton.js  → Loaded only on Honeygrid homepage
```

**JavaScript directory names determine the page:**
`product_info/`, `product_listing/`, `checkout_*/`, `shopping_cart/`, `index/`

You can also override Smarty templates by placing `.html` files in `Shop/Themes/All/` mirroring the theme's directory structure.

### 9. TextPhrases — Translations

Language files use the naming convention `{section_name}.lang.inc.php`:

```
Admin/TextPhrases/german/skeleton_module.lang.inc.php
Admin/TextPhrases/english/skeleton_module.lang.inc.php
```

Reference phrases in `GXModule.json`, `.menu.json`, or Smarty templates using the pattern:
`{section}.{KEY}` — e.g. `skeleton_module.PAGE_TITLE`

In Smarty templates: `{load_language_text section="skeleton_module"}` then `{$txt.KEY}`

## Store Metadata

### store.json

The `store.json` file configures your module's Gambio Store listing:

| Field | Description |
|-------|-------------|
| `name` | Internal package name |
| `code` | Unique module code |
| `type` | Package type (`module`) |
| `title` | Display title (multilingual) |
| `description` | HTML description (multilingual), overridden by `.assets/{lang}/description.html` |
| `vendor` | Vendor information (name, URL, avatar) |
| `highlights` | Feature bullet points for Store listing |
| `migrations` | Database migration scripts (up/down) |
| `requirements` | PHP, MySQL, and shop version requirements |

### .assets Directory

| File | Description |
|------|-------------|
| `module_logo(.png\|.jpg\|.svg)` | Module logo for Store listing |
| `vendor_logo(.png\|.jpg\|.svg)` | Vendor logo for Store listing |
| `de/description.html` | German description (overrides store.json) |
| `en/description.html` | English description (overrides store.json) |
| `placeholder.png` | Use `[placeholder.png]` in description HTML to reference store-hosted images |

## Requirements

- **Gambio GX5** (shop version >= 5.0.0.0)
- **PHP** >= 8.0
- **MySQL** >= 5.5

## Further Reading

- [Gambio Developer Documentation](https://developers.gambio.de/)
- [Gambio Store Documentation](https://developers.gambio.de/)
