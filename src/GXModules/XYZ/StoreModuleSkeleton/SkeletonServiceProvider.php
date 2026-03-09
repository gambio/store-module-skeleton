<?php

/**
 * Service Provider for the Skeleton Module.
 *
 * Use AbstractModuleBootableServiceProvider to get access to boot() which runs
 * AFTER all service providers have been registered. This is the right place for
 * event listener registration and post-registration setup.
 *
 * For simple DI registration without boot(), use AbstractModuleServiceProvider instead.
 */

namespace GXModules\XYZ\Skeleton;

use Gambio\Core\Application\DependencyInjection\AbstractModuleBootableServiceProvider;

class SkeletonServiceProvider extends AbstractModuleBootableServiceProvider
{
    /**
     * List of services this provider can register.
     * Return class names or interface names that provides() makes available.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            // Example: List services this provider registers
            // SkeletonService::class,
            // SkeletonRepositoryInterface::class,
        ];
    }


    /**
     * Register services in the DI container.
     * Called once during application bootstrap.
     *
     * Use $this->application->registerShared() for singletons.
     * Use $this->application->register() for new instances per request.
     */
    public function register(): void
    {
        // Example: Register a service as shared (singleton)
        //
        // $this->application->registerShared(SkeletonService::class, function () {
        //     return new SkeletonService(
        //         $this->application->get(\Gambio\Core\Configuration\ConfigurationService::class)
        //     );
        // });

        // Example: Bind an interface to an implementation
        //
        // $this->application->registerShared(
        //     SkeletonRepositoryInterface::class,
        //     SkeletonDatabaseRepository::class
        // );
    }


    /**
     * Boot the module after all providers are registered.
     * This is the right place for event listeners and inflections.
     */
    public function boot(): void
    {
        // Example: Attach an event listener
        //
        // $this->application->attachEventListener(
        //     \Gambio\Core\Order\Events\TrackingCodeCreated::class,
        //     \GXModules\XYZ\Skeleton\EventListeners\OnTrackingCodeCreated::class
        // );

        // Example: Inflect a class to call a method after construction
        //
        // $this->application->inflect(SomeClass::class)
        //     ->invokeMethod('setSkeleton', [SkeletonService::class]);
    }
}
