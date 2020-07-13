# Store Module Skeleton

Skeleton project for new Gambio Store packages.

# 1. Module structure description

##### 1.1 Files structure
```
├── GXModules
│   └── XYZ
│       └── Skeleton
│           ├── Admin
│           │   ├── Controllers
│           │   │   ├── index.html
│           │   │   ├── SkeletonModuleAjaxController.inc.php
│           │   │   └── SkeletonModuleController.inc.php
│           │   ├── Core
│           │   │   ├── index.html
│           │   │   ├── SkeletonConfiguration.php
│           │   │   └── SkeletonTimeManager.php
│           │   ├── Html
│           │   │   ├── index.html
│           │   │   ├── skeleton_configuration.html
│           │   │   └── skeleton_module.html
│           │   ├── Javascript
│           │   │   ├── index.html
│           │   │   └── timer.js
│           │   ├── Menu
│           │   │   ├── index.html
│           │   │   └── menu_skeleton.xml
│           │   ├── Styles
│           │   │   ├── index.html
│           │   │   └── skeleton_module.css
│           │   └── TextPhrases
│           │       ├── english
│           │       │   ├── index.html
│           │       │   └── skeleton_module.lang.inc.php
│           │       ├── german
│           │       │   ├── index.html
│           │       │   └── skeleton_module.lang.inc.php
│           │       └── index.html
│           ├── GXModule.json
│           └── index.html
├── README.md
├── store.json
└── version_info
    └── store_module_skeleton-1_0_0.php
```

##### 1.2 The files description

- **store.json** - module configuration file
- **README.md** - this file
- **version_info/store_module_skeleton-1_0_0.php** - the identifier file. It is used by the store to identify versions of installed modules.
- **GXModules/XYZ/Skeleton/GXModule.json** - the file enables the automatic integration of your module into the Module Center and the generation of a configuration page based on a JSON configuration file.
- **GXModules/XYZ/Skeleton/Admin/TextPhrases/english/skeleton_module.lang.inc.php** - File containing English language translation strings
- **GXModules/XYZ/Skeleton/Admin/TextPhrases/german/skeleton_module.lang.inc.php** - File containing German language translation strings
- **GXModules/XYZ/Skeleton/Admin/Javascript/timer.js** - contains javascript logic of the plugin.
- **GXModules/XYZ/Skeleton/Admin/Html/skeleton_module.html** - HTML template file, using for rendering the main page of the module
- **GXModules/XYZ/Skeleton/Admin/Html/skeleton_configuration.html** - HTML template file, using for rendering the configuration page of the module
- **GXModules/XYZ/Skeleton/Admin/Core/SkeletonConfiguration.php** - Core functionality file. Responsible for the plugin configuration.
- **GXModules/XYZ/Skeleton/Admin/Core/SkeletonTimeManager.php** - Core functionality file. Contains main logic of the module.
- **GXModules/XYZ/Skeleton/Admin/Controllers/SkeletonModuleAjaxController.inc.php** - Controller for handling ajax requests of the module.
- **GXModules/XYZ/Skeleton/Admin/Controllers/SkeletonModuleController.inc.php** - Controller for managing and rendering the module pages.
- **GXModules/XYZ/Skeleton/Admin/Menu/menu_skeleton.xml** - Menu configuration for the module.
- **GXModules/XYZ/Skeleton/Admin/Styles/skeleton_module.css** - CSS asset file for the module.

# 2. Receipt file
To register and use the module in the Gambio Store, the module must have a receipt file that is used as an identifier.
The file must be located in the version_info folder at the root of the module's repository. The file name must be the value for the shopIdentifier field in the store.json file.
The file name can be any, but for convenience it is desirable to use the following sample; {module_name}-{version}.php, e.g. store_module_skeleton-1_0_0.php

# 3. The GX Module
This module is an example of a GX Module that demonstrates the features of the GXModules system and has the appropriate file structure. You can read more about creating GXModules module at [https://developers.gambio.de/](https://developers.gambio.de/).

# 4. Module controllers.
The controllers are provided for processing requests and performing any actions by the module. Each controller inherits the HttpViewController (or successor). To perform an action by the controller, the address must contain the parameter "do", such as admin/admin.php?do=SkeletonModule/Configuration trigger method actionConfiguration class SkeletonModuleController.
You can read more about controllers in GXModules module at [https://developers.gambio.de/](https://developers.gambio.de/).

# 5. Adding custom assets and translations.

##### 5.1 Assets.
It is possible to add custom javascript and css files to your module. To do that you would have to provide assets collection with provided asset files.
For example:
```$xslt
        $assets            = new AssetCollection([
            new Asset('../GXModules/XYZ/Skeleton/Admin/Javascript/timer.js'),
            new Asset('../GXModules/XYZ/Skeleton/Admin/Styles/skeleton_module.css'),
        ]);
```

##### 5.2 Translations.

You can translate text of your module using language files within the TextPhrases/{language} folder.
The following naming convention is used when creating a language file: {section_name}.lang.inc.php, e.g. ```skeleton_module.lang.inc.php```

To use the file in a template you have to include the file by its section name: ```{load_language_text section="skeleton_module"}```

You can read more about adding assets and translations at [https://developers.gambio.de/](https://developers.gambio.de/).
