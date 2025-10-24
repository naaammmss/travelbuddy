<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$routes = app('router')->getRoutes();
$out = [];
foreach ($routes as $r) {
    $out[] = [
        'uri' => $r->uri(),
        'name' => $r->getName(),
        'action' => $r->getActionName(),
        'middleware' => $r->gatherMiddleware(),
    ];
}
echo json_encode($out, JSON_PRETTY_PRINT);
