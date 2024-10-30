# Store Module Skeleton

Skeleton project for new Gambio Store packages.

# 1. Module structure description

##### 1.1 Files structure

Below you can see the module filesystem tree structure where the **XYZ** folder refers to a Vendor name and the **XYZ/Skeleton** to the module name.

```
├── .assets
│   └── vendor_logo(.png|.jpg|.svg)
│   └── module_logo(.png|.jpg|.svg)
│   └── de
│       ├── description.html
│   └── en
│       ├── description.html
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
│           ├── SkeletonServiceProvider.php
│           ├── composer.json
│           ├── GXModule.json
│           └── index.html
├── README.md
├── store.json
```

##### 1.2 The files description

- **.assets/module_logo(.png|.jpg|.svg)** - The Module Logo. Supported are PNG, JPG and SVG Files.
- **.assets/vendor_logo(.png|.jpg|.svg)** - The Vendor Logo. Supported are PNG, JPG and SVG Files.
- **.assets/de/description.html** - The german Description for the Module. If this file exists, the description key in the store.json will be ignored.
- **.assets/en/description.html** - The english Description for the Module. If this file exists, the description key in the store.json will be ignored.
- **store.json** - Gambio Store configuration file.
- **README.md** - this file
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

# 2. Module Description
You can use your own Screenshots to be injected in the Description inside of the store.json.
In the .assets Folder is an example placeholder.png File. To get it injected in the Description, you have to wrap the Filename inside Brackets, e.g. [placeholder.png]
This Placeholder will be replaced by our System to provide URLs to the processed asset File.

# 3. The GX Module
This module is an example of a GX Module that demonstrates the features of the GXModules system and has the appropriate file structure. You can read more about creating GXModules module at [https://developers.gambio.de/](https://developers.gambio.de/).

# 4. Module controllers.
The controllers are provided for processing requests and performing any actions by the module.
There are two PHP scripts that can manage controllers actions - ```shop.php``` and ```admin/admin.php```.
Each controller inherits the HttpViewController (or its successor, for example, ``AdminHttpViewController`` in this module).
To perform an action within the controller, the address must contain the parameter ```do```.
The value of the parameter with the key ```do``` specifies the controller and action method.
The part of the value before the slash will be used to form the controller name by appending the "Controller" word, whereas the part after the slash will be prepended the "action" word.
For example, admin/admin.php?do=SkeletonModule/Configuration trigger method ```actionConfiguration``` of the ```SkeletonModuleController``` class.
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

To include the assets to the module page the assets collection should be passed as an argument to the ```HttpControllerResponse``` (or its successor, ``AdminHttpViewController`` in this module).


##### 5.2 Translations.

You can translate text of your module using language files within the TextPhrases/{language} folder.
The following naming convention is used when creating a language file: {section_name}.lang.inc.php, e.g. ```skeleton_module.lang.inc.php```

To use the file in a template you have to include the file by its section name: ```{load_language_text section="skeleton_module"}```

You can read more about adding assets and translations at [https://developers.gambio.de/](https://developers.gambio.de/).
