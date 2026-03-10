<?php

/**
 * Lifecycle hook for module installation and uninstallation.
 *
 * Referenced in GXModule.json under "install" and "uninstall".
 * The method signature depends on how the class is resolved:
 *
 * - If registered in the DI container (via ServiceProvider):
 *   The method receives a single array argument: the parsed GXModule.json data.
 *
 * - If resolved via MainFactory (fallback):
 *   The method receives: ($db, $moduleData, $languageTextManager, $cacheControl)
 *
 * Use this for database table creation, default data seeding, or cleanup on uninstall.
 */

namespace GXModules\XYZ\Skeleton\Admin\Actions;

class SkeletonInstallAction
{
    /**
     * Called when the module is installed via Module Center.
     *
     * @param \CI_DB_query_builder       $db
     * @param array                      $moduleData          Parsed GXModule.json content
     * @param \LanguageTextManager       $languageTextManager
     * @param \DataCache                 $cacheControl
     */
    public function onInstall($db, array $moduleData, $languageTextManager, $cacheControl): void
    {
        // Example: Create a custom database table for the module
        //
        // $db->query("
        //     CREATE TABLE IF NOT EXISTS `skeleton_module_data` (
        //         `id` INT(11) NOT NULL AUTO_INCREMENT,
        //         `name` VARCHAR(255) NOT NULL,
        //         `value` TEXT,
        //         `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
        //         PRIMARY KEY (`id`)
        //     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        // ");

        // Clear caches after installation
        $cacheControl->clear_all();
    }


    /**
     * Called when the module is uninstalled via Module Center.
     *
     * If this method is NOT defined in GXModule.json "uninstall", all configuration
     * values are automatically deleted. Define it only if you need custom cleanup.
     *
     * @param \CI_DB_query_builder       $db
     * @param array                      $moduleData
     * @param \LanguageTextManager       $languageTextManager
     * @param \DataCache                 $cacheControl
     */
    public function onUninstall($db, array $moduleData, $languageTextManager, $cacheControl): void
    {
        // Example: Drop custom tables
        //
        // $db->query("DROP TABLE IF EXISTS `skeleton_module_data`");

        $cacheControl->clear_all();
    }
}
