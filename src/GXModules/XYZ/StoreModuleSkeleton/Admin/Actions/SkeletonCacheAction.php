<?php

/**
 * Action handler for GXModule.json "button" actions.
 *
 * Extends GXModuleController which provides $this->config (GXModuleConfigurationStorage).
 * Used for AJAX buttons and modal confirm actions in the auto-generated configuration page.
 */

namespace GXModules\XYZ\Skeleton\Admin\Actions;

class SkeletonCacheAction extends \GXModuleController
{
    /**
     * Called when the "Clear Cache" button is clicked.
     *
     * @param array $data Request data
     *
     * @return void
     */
    public function clearCache(array $data): void
    {
        // Example: Clear module-specific caches
        //
        // $cacheDir = DIR_FS_CATALOG . 'cache/skeleton/';
        // if (is_dir($cacheDir)) {
        //     array_map('unlink', glob($cacheDir . '*'));
        // }
    }


    /**
     * Called when the user confirms the "Reset All" modal.
     *
     * @param array $data Request data
     *
     * @return void
     */
    public function resetAll(array $data): void
    {
        // Example: Reset all module data to defaults
        //
        // $this->config->set('enableFeature', '0');
        // $this->config->set('maxItems', '10');
        // $this->config->set('displayMode', 'grid');
    }
}
