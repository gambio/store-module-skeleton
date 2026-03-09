<?php

/**
 * Cronjob Task — the main execution logic.
 *
 * Naming convention: The class name must match the JSON "name" field + "Task".
 * File name: {Name}Task.inc.php in the same CronjobConfiguration directory.
 *
 * Required companion files:
 *   - SkeletonCronjob.json             — Configuration (interval, active state)
 *   - SkeletonCronjobDependencies.inc.php — DI dependencies
 *   - SkeletonCronjobLogger.inc.php    — Logging
 *   - TextPhrases/{lang}/cronjob_skeleton.lang.inc.php — UI translations
 */

// @codingStandardsIgnoreStart
class SkeletonCronjobTask extends AbstractCronjobTask
// @codingStandardsIgnoreEnd
{
    /**
     * Main cronjob execution method.
     *
     * @param array $cronjobStartArguments Arguments passed from the scheduler
     *
     * @return void
     */
    public function run(array $cronjobStartArguments): void
    {
        $this->logger->log('Skeleton cronjob started');

        // Example: Perform periodic task
        //
        // try {
        //     $service = $this->dependencies->getSkeletonService();
        //     $result = $service->syncData();
        //     $this->logger->log('Synced ' . $result->count() . ' items');
        // } catch (\Exception $e) {
        //     $this->logger->logError('Sync failed: ' . $e->getMessage());
        // }

        $this->logger->log('Skeleton cronjob finished');
    }
}
