<?php

use Illuminate\Support\Facades\Route;

Route::get('/test-middleware', function() {
    $router = app('router');
    dd([
        'middlewareGroups' => $router->getMiddlewareGroups(),
        'routeMiddleware' => $router->getMiddleware(),
        'middlewareAliases' => app()->make(\App\Http\Kernel::class)->middlewareAliases,
    ]);
});