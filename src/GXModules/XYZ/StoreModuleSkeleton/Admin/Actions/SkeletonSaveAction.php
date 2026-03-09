<?php

/**
 * After-save hook for configuration changes.
 *
 * Referenced in GXModule.json under "save".
 * Called every time the user saves the configuration page.
 *
 * Use this for cache invalidation, config validation, or triggering side effects.
 */

namespace GXModules\XYZ\Skeleton\Admin\Actions;

class SkeletonSaveAction
{
    /**
     * Called after configuration values are saved.
     *
     * @param \CI_DB_query_builder              $db
     * @param \GXModuleConfigurationStorage     $configurationStorage
     * @param \LanguageTextManager              $languageTextManager
     * @param \DataCache                        $cacheControl
     */
    public function onSave($db, $configurationStorage, $languageTextManager, $cacheControl): void
    {
        // Example: Read a saved config value and perform an action
        //
        // $apiKey = $configurationStorage->get('apiKey');
        // if (!empty($apiKey)) {
        //     // Validate the API key, sync data, etc.
        // }

        // Clear caches after config change
        $cacheControl->clear_all();
    }
}
