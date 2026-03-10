<?php

/**
 * Module class for the Skeleton Module.
 *
 * This file is auto-detected by the ModuleProcessor when named *Module.php
 * at the module root level. It provides a declarative way to register:
 *
 * - Event listeners (PSR-14)
 * - HTTP middleware (PSR-15) for shop, admin, and API
 * - Module dependencies
 *
 * This is an alternative to registering event listeners in the ServiceProvider boot().
 * Use whichever pattern fits your needs — or both.
 */

namespace GXModules\XYZ\Skeleton;

use Gambio\Core\Application\Modules\AbstractModule;

class SkeletonModule extends AbstractModule
{
    /**
     * Register event listeners.
     *
     * Return an associative array mapping event class names to arrays of listener class names.
     * Listeners are resolved from the DI container (register them in the ServiceProvider).
     *
     * @return array<class-string, class-string[]>|null
     */
    public function eventListeners(): ?array
    {
        return [
            // Example: Listen for order tracking code creation
            //
            // \Gambio\Core\Order\Events\TrackingCodeCreated::class => [
            //     \GXModules\XYZ\Skeleton\EventListeners\OnTrackingCodeCreated::class,
            // ],
        ];
    }


    /**
     * Declare dependencies on other GXModules.
     *
     * Return an array of fully qualified module class names that must be loaded before this one.
     *
     * @return class-string[]|null
     */
    public function dependsOn(): ?array
    {
        return [
            // Example: Depend on another module
            //
            // \GXModules\Gambio\Hub\HubModule::class,
        ];
    }


    /**
     * Register PSR-15 middleware for storefront (shop.php) requests.
     *
     * Middleware classes are resolved from the DI container.
     *
     * @return class-string[]|null
     */
    public function shopMiddleware(): ?array
    {
        return [
            // Example: Add middleware that runs on every storefront request
            //
            // \GXModules\XYZ\Skeleton\Middleware\SkeletonShopMiddleware::class,
        ];
    }


    /**
     * Register PSR-15 middleware for admin (admin.php) requests.
     *
     * @return class-string[]|null
     */
    public function adminMiddleware(): ?array
    {
        return [
            // Example: Add middleware that runs on every admin request
            //
            // \GXModules\XYZ\Skeleton\Middleware\SkeletonAdminMiddleware::class,
        ];
    }


    /**
     * Register PSR-15 middleware for REST API v3 requests.
     *
     * @return class-string[]|null
     */
    public function apiMiddleware(): ?array
    {
        return [
            // Example: Add API authentication middleware
            //
            // \GXModules\XYZ\Skeleton\Middleware\SkeletonApiMiddleware::class,
        ];
    }
}
