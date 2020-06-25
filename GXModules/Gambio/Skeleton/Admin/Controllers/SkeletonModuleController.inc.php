<?php
/* --------------------------------------------------------------
   SkeletonModuleController.inc.php 2020-06-25
   Gambio GmbH
   http://www.gambio.de
   Copyright (c) 2020 Gambio GmbH
   Released under the GNU General Public License (Version 2)
   [http://www.gnu.org/licenses/gpl-2.0.html]
   --------------------------------------------------------------
*/

class SkeletonModuleController extends AdminHttpViewController
{
    /**
     * Determines whether to display the data processing terms, the registration or the downloads page of the iframe
     *
     * @return mixed

     */
    public function actionDefault()
    {
        $languageTextManager = new LanguageTextManager('skeleton_module', $_SESSION['languages_id']);
        $title             = new NonEmptyStringType($languageTextManager->get_text('PAGE_TITLE', 'skeleton_module'));
        $template          = new ExistingFile(new NonEmptyStringType(__DIR__ . '/../Html/skeleton_module.html'));

        $contentNavigation = MainFactory::create('ContentNavigationCollection', []);
        $contentNavigation->add(new StringType($languageTextManager->get_text('HOME', 'skeleton_module')), new StringType('admin.php?do=SkeletonModule'), new BoolType(true));
        $contentNavigation->add(new StringType($languageTextManager->get_text('CONFIGURATION', 'skeleton_module')), new StringType('admin.php?do=SkeletonModule/configuration'), new BoolType(false));

        $assets            = new AssetCollection([
            new Asset('../GXModules/Gambio/Skeleton/Admin/Javascript/timer.js'),
            new Asset('../GXModules/Gambio/Skeleton/Admin/Styles/skeleton_module.css'),
        ]);
        $data              = new KeyValueCollection([]);

        return new AdminLayoutHttpControllerResponse($title, $template, $data, $assets, $contentNavigation);
    }
}
