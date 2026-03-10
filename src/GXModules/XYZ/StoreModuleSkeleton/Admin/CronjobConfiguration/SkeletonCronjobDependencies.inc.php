<?php

/**
 * Cronjob Dependencies — provides access to services for the task.
 *
 * The Dependencies class is injected into the Task at runtime.
 * Use it to access database connections, services, or other dependencies.
 */

// @codingStandardsIgnoreStart
class SkeletonCronjobDependencies extends AbstractCronjobDependencies
// @codingStandardsIgnoreEnd
{
    // Example: Provide a service to the cronjob task
    //
    // public function getSkeletonService(): \GXModules\XYZ\Skeleton\SkeletonService
    // {
    //     return \MainFactory::create(\GXModules\XYZ\Skeleton\SkeletonService::class);
    // }

    // Example: Provide a database connection
    //
    // public function getDb(): \CI_DB_query_builder
    // {
    //     return \StaticGXCoreLoader::getDatabaseQueryBuilder();
    // }
}
