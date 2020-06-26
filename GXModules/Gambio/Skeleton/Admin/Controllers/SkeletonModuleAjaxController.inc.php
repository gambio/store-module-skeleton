<?php
/* --------------------------------------------------------------
   SkeletonModuleAjaxController.inc.php 2020-06-26
   Gambio GmbH
   http://www.gambio.de
   Copyright (c) 2020 Gambio GmbH
   Released under the GNU General Public License (Version 2)
   [http://www.gnu.org/licenses/gpl-2.0.html]
   --------------------------------------------------------------
*/

class SkeletonModuleAjaxController extends AdminHttpViewController
{
    public function actionSetTimerConfigurationValue()
    {
        // Set value to database
        $responseData = ['success' => true];
        return new JsonHttpControllerResponse($responseData);
    }
}
