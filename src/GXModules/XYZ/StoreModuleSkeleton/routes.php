<?php

/**
 * HTTP route registration for the Skeleton Module.
 *
 * This file is auto-detected by the RoutesProcessor. It must be named routes.php
 * and placed at the module root level.
 *
 * Routes defined here are added to the FastRoute router. Available HTTP methods:
 *   $routeCollector->get($path, $handler)
 *   $routeCollector->post($path, $handler)
 *   $routeCollector->put($path, $handler)
 *   $routeCollector->patch($path, $handler)
 *   $routeCollector->delete($path, $handler)
 *   $routeCollector->options($path, $handler)
 *   $routeCollector->any($path, $handler)           // All methods
 *   $routeCollector->map($methods, $path, $handler)  // Custom method list
 *   $routeCollector->group($prefix, $callback)        // Group routes under a prefix
 *
 * Handler classes are PSR-15 RequestHandlerInterface implementations,
 * resolved from the DI container. Register them in the ServiceProvider.
 *
 * Route parameters use FastRoute syntax: {param} or {param:\d+}
 */

use Gambio\Core\Application\Routing\RouteCollector;

return static function (RouteCollector $routeCollector) {

    // Example: Admin page route (renders a custom admin page)
    //
    // $routeCollector->get(
    //     '/admin/skeleton',
    //     \GXModules\XYZ\Skeleton\Admin\Actions\SkeletonOverviewAction::class
    // );

    // Example: Admin API endpoints (JSON)
    //
    // $routeCollector->group('/admin/api/skeleton', function (RouteCollector $group) {
    //     $group->get('', \GXModules\XYZ\Skeleton\Admin\Actions\Json\FetchAllAction::class);
    //     $group->get('/{id:\d+}', \GXModules\XYZ\Skeleton\Admin\Actions\Json\FetchAction::class);
    //     $group->post('', \GXModules\XYZ\Skeleton\Admin\Actions\Json\CreateAction::class);
    //     $group->put('/{id:\d+}', \GXModules\XYZ\Skeleton\Admin\Actions\Json\UpdateAction::class);
    //     $group->delete('/{id:\d+}', \GXModules\XYZ\Skeleton\Admin\Actions\Json\DeleteAction::class);
    // });

    // Example: Storefront route (e.g. a public-facing page or webhook)
    //
    // $routeCollector->get(
    //     '/skeleton/widget',
    //     \GXModules\XYZ\Skeleton\Shop\Actions\WidgetAction::class
    // );
    //
    // $routeCollector->post(
    //     '/skeleton/webhook',
    //     \GXModules\XYZ\Skeleton\Shop\Actions\WebhookAction::class
    // );
};
