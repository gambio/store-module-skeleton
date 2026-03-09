<?php

/**
 * Cronjob Logger — handles log output for the cronjob.
 *
 * Logs are displayed in the Gambio admin under Toolbox > Cronjobs.
 * Extend AbstractCronjobLogger and optionally customize log behavior.
 */

// @codingStandardsIgnoreStart
class SkeletonCronjobLogger extends AbstractCronjobLogger
// @codingStandardsIgnoreEnd
{
    // The default implementation from AbstractCronjobLogger is usually sufficient.
    // Override methods only if you need custom log formatting or destinations.
    //
    // Available methods from parent:
    //   $this->log($message)       — Log an info message
    //   $this->logError($message)  — Log an error message
}
