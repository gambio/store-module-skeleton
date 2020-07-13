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
