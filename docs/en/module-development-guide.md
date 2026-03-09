# Module Development Guide

This guide walks you through building a Gambio GX module from scratch using the [Store Module Skeleton](https://github.com/gambio/store-module-skeleton).

## Prerequisites

- A Gambio shop installation (local or test system)
- PHP >= 8.0
- Basic knowledge of PHP, HTML, CSS, and JavaScript
- A GitHub account (required for Store publishing)

## How Gambio Modules Work

Every Gambio module lives inside `src/GXModules/{Vendor}/{ModuleName}/`. The `{Vendor}` folder is your company or developer name, and `{ModuleName}` is the name of your module.

The only **required** file is `GXModule.json`. This file registers your module in the Module Center, where shop administrators can install and uninstall it. Everything else is optional and depends on what your module needs to do.

## Step 1: Create the Module Directory

```
src/GXModules/AcmeCorp/MyModule/
```

Replace `AcmeCorp` with your vendor name and `MyModule` with your module name.

## Step 2: Create GXModule.json

This is the only mandatory file. At minimum:

```json
{
    "title": "my_module.PAGE_TITLE",
    "description": "my_module.DESCRIPTION"
}
```

This registers your module in the Module Center. The values reference translation keys from your TextPhrases files.

### Adding Configuration Fields

To give administrators a settings page, add the `configuration` array:

```json
{
    "title": "my_module.PAGE_TITLE",
    "description": "my_module.DESCRIPTION",
    "configuration": [
        {
            "title": "my_module.SECTION_SETTINGS",
            "fields": {
                "enableFeature": {
                    "type": "checkbox",
                    "label": "my_module.LABEL_ENABLE"
                },
                "apiKey": {
                    "type": "text",
                    "label": "my_module.LABEL_API_KEY",
                    "required": true
                }
            }
        }
    ]
}
```

Gambio automatically generates the configuration page from this JSON. No HTML templates or controllers needed.

For the complete field type reference, see [GXModule.json Reference](./gxmodule-json-reference.md).

### Adding Lifecycle Hooks

You can run custom PHP code when the module is installed, uninstalled, or when settings are saved:

```json
{
    "install": {
        "controller": "GXModules\\AcmeCorp\\MyModule\\Admin\\Actions\\InstallAction",
        "method": "onInstall"
    },
    "uninstall": {
        "controller": "GXModules\\AcmeCorp\\MyModule\\Admin\\Actions\\InstallAction",
        "method": "onUninstall"
    },
    "save": {
        "controller": "GXModules\\AcmeCorp\\MyModule\\Admin\\Actions\\SaveAction",
        "method": "onSave"
    }
}
```

The install method receives `($db, $moduleData, $languageTextManager, $cacheControl)`. Use it for database table creation or initial data seeding.

The save method receives `($db, $configurationStorage, $languageTextManager, $cacheControl)`. Use it for cache invalidation or validation after config changes.

## Step 3: Add Translations

Create language files so your module labels are translatable:

```
Admin/TextPhrases/german/my_module.lang.inc.php
Admin/TextPhrases/english/my_module.lang.inc.php
```

Each file returns a key-value array:

```php
<?php
$t_language_text_section_content_array = [
    'PAGE_TITLE'     => 'My Module',
    'DESCRIPTION'    => 'This module does something useful.',
    'SECTION_SETTINGS' => 'Settings',
    'LABEL_ENABLE'   => 'Enable feature',
    'LABEL_API_KEY'  => 'API Key',
];
```

The section name comes from the filename (without `.lang.inc.php`). Reference keys in GXModule.json as `{section}.{KEY}`, e.g. `my_module.PAGE_TITLE`.

## Step 4: Add Storefront Customizations (Optional)

### CSS

Place CSS files in `Shop/Themes/All/Css/` to load them on every storefront page across all themes:

```
Shop/Themes/All/Css/my_module.css
```

To target a specific theme, replace `All` with the theme name:

```
Shop/Themes/Malibu/Css/my_module.css
```

### JavaScript

Place JavaScript files in `Shop/Themes/All/Javascript/{page}/` where `{page}` matches the storefront page:

```
Shop/Themes/All/Javascript/product_info/my_module.js   : Product detail page
Shop/Themes/All/Javascript/product_listing/my_module.js : Category listing
Shop/Themes/All/Javascript/shopping_cart/my_module.js   : Shopping cart
Shop/Themes/All/Javascript/index/my_module.js           : Homepage
```

### Smarty Template Overrides

Override Smarty template snippets by mirroring the theme directory structure:

```
Shop/Themes/All/snippets/footer/footer.html
```

This replaces the default footer template across all themes.

## Step 5: Add an Admin Menu Entry (Optional)

Create `Admin/Menu/my_module.menu.json` to add an entry to the admin sidebar:

```json
[{
    "id": "BOX_HEADING_MY_MODULE",
    "sort": 400,
    "class": "fa fa-puzzle-piece",
    "title": "my_module.PAGE_TITLE",
    "type": "standalone",
    "items": [{
        "sort": 10,
        "link": "admin.php?do=MyModule",
        "title": "my_module.PAGE_TITLE"
    }]
}]
```

This replaces the deprecated XML menu format (`menu_*.xml`).

## Step 6: Extend Existing Functionality with Overloads (Optional)

Overloads let you extend any class managed by Gambio's MainFactory.

### Admin Overloads

Place files in `Admin/Overloads/{ClassName}/`:

```php
// Admin/Overloads/OrderExtenderComponent/MyModuleOrderExtender.inc.php

class MyModuleOrderExtender extends MyModuleOrderExtender_parent
{
    public function proceed()
    {
        parent::proceed();
        // Your custom logic here
    }
}
```

Common admin overload targets:
- `OrderExtenderComponent`: Order detail page
- `AdminApplicationTopExtenderComponent`: Every admin page (early)
- `AdminEditProductExtenderComponent`: Product editing page
- `PDFOrderExtenderComponent`: PDF invoice generation

### Shop Overloads

Place files in `Shop/Overloads/{ClassName}/`:

```php
// Shop/Overloads/ApplicationTopExtenderComponent/MyModuleAppTop.inc.php

class MyModuleAppTop extends MyModuleAppTop_parent
{
    public function proceed()
    {
        parent::proceed();
        // Runs on every storefront page load
    }
}
```

Rules:
1. Your class **must** extend `{ClassName}_parent` (a pseudo-class resolved by MainFactory)
2. **Always** call the parent method to preserve the overload chain
3. The file **must** use the `.inc.php` extension

## Step 7: Add a ServiceProvider for Dependency Injection (Optional)

Create `MyModuleServiceProvider.php` at the module root to register services in the DI container:

```php
<?php

namespace GXModules\AcmeCorp\MyModule;

use Gambio\Core\Application\DependencyInjection\AbstractModuleBootableServiceProvider;

class MyModuleServiceProvider extends AbstractModuleBootableServiceProvider
{
    public function provides(): array
    {
        return [MyService::class];
    }

    public function register(): void
    {
        $this->application->registerShared(MyService::class, function () {
            return new MyService(
                $this->application->get(\Gambio\Core\Configuration\ConfigurationService::class)
            );
        });
    }

    public function boot(): void
    {
        // Register event listeners after all providers are loaded
        $this->application->attachEventListener(
            SomeEvent::class,
            MyEventListener::class
        );
    }
}
```

Use `AbstractModuleBootableServiceProvider` when you need `boot()` (for event listeners). Use `AbstractModuleServiceProvider` if you only need `register()`.

## Step 8: Add a Module Class for Events and Middleware (Optional)

Create `MyModuleModule.php` at the module root. It is auto-detected when named `*Module.php`:

```php
<?php

namespace GXModules\AcmeCorp\MyModule;

use Gambio\Core\Application\Modules\AbstractModule;

class MyModuleModule extends AbstractModule
{
    public function eventListeners(): ?array
    {
        return [
            SomeEvent::class => [MyListener::class],
        ];
    }

    public function shopMiddleware(): ?array
    {
        return [MyShopMiddleware::class];
    }

    public function adminMiddleware(): ?array
    {
        return [];
    }

    public function apiMiddleware(): ?array
    {
        return [];
    }

    public function dependsOn(): ?array
    {
        return [];
    }
}
```

## Step 9: Add HTTP Routes (Optional)

Create `routes.php` at the module root for custom HTTP endpoints:

```php
<?php

use Gambio\Core\Application\Routing\RouteCollector;

return static function (RouteCollector $routeCollector) {
    $routeCollector->get('/admin/my-module', MyOverviewAction::class);

    $routeCollector->group('/admin/api/my-module', function (RouteCollector $group) {
        $group->get('', FetchAllAction::class);
        $group->post('', CreateAction::class);
        $group->put('/{id:\d+}', UpdateAction::class);
        $group->delete('/{id:\d+}', DeleteAction::class);
    });
};
```

Handler classes must implement PSR-15 `RequestHandlerInterface` and should be registered in the ServiceProvider.

## Step 10: Add a Cronjob (Optional)

Register a scheduled task with 4 files in `Admin/CronjobConfiguration/`:

**MyCronjob.json**: Configuration:
```json
{
    "name": "MyCronjob",
    "title": "my_cronjob.TITLE",
    "configuration": {
        "active": {
            "name": "active",
            "type": "checkbox",
            "label": "my_cronjob.LABEL_ACTIVE",
            "defaultValue": false
        },
        "interval": {
            "name": "interval",
            "type": "select",
            "label": "my_cronjob.LABEL_INTERVAL",
            "defaultValue": "0 * * * *",
            "values": [
                { "value": "*/5 * * * *", "text": "my_cronjob.EVERY_5_MINUTES" },
                { "value": "0 * * * *",   "text": "my_cronjob.EVERY_HOUR" },
                { "value": "0 0 * * *",   "text": "my_cronjob.EVERY_DAY" }
            ]
        }
    }
}
```

**MyCronjobTask.inc.php**: Execution logic:
```php
class MyCronjobTask extends AbstractCronjobTask
{
    public function run(array $cronjobStartArguments): void
    {
        $this->logger->log('Starting sync...');
        // Your scheduled task logic
        $this->logger->log('Sync complete.');
    }
}
```

**MyCronjobDependencies.inc.php**: Dependencies:
```php
class MyCronjobDependencies extends AbstractCronjobDependencies
{
    // Add getter methods for services the task needs
}
```

**MyCronjobLogger.inc.php**: Logger:
```php
class MyCronjobLogger extends AbstractCronjobLogger
{
    // Default implementation is usually sufficient
}
```

Add translations in `Admin/TextPhrases/{lang}/my_cronjob.lang.inc.php`.

## Step 11: Add index.html Files

Place an empty `<html></html>` file named `index.html` in **every directory** of your module. This is a Gambio convention to prevent directory listing on web servers:

```html
<html></html>
```

## Minimal vs. Full Module

Not every module needs all extension points. Here are some examples:

**CSS-only module** (just style changes):
```
GXModules/AcmeCorp/PinkButtons/
    GXModule.json
    Shop/Themes/All/Css/pink_buttons.css
```

**JavaScript enhancement** (no PHP needed):
```
GXModules/AcmeCorp/ProductEnhancer/
    GXModule.json
    Shop/Themes/All/Javascript/product_info/enhancer.js
```

**Full-featured module** (all extension points):
```
GXModules/AcmeCorp/MyModule/
    GXModule.json
    MyModuleServiceProvider.php
    MyModuleModule.php
    routes.php
    Admin/Actions/...
    Admin/CronjobConfiguration/...
    Admin/Menu/my_module.menu.json
    Admin/Overloads/...
    Admin/TextPhrases/...
    Shop/Overloads/...
    Shop/Themes/All/...
```

## Next Steps

- [GXModule.json Reference](./gxmodule-json-reference.md): Complete field type documentation
- [Local Testing](./local-testing.md): How to test your module
- [store.json Reference](./store-json-reference.md): Store metadata format
- [Publishing Guide](./publishing-guide.md): How to submit to the Gambio Store
