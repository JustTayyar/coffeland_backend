<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $controller = app()->make(\App\Http\Controllers\Api\Admin\DashboardController::class);
    $request = new \Illuminate\Http\Request();
    $response = $controller->index($request);
    echo json_encode($response->getData());
} catch (\Exception $e) {
    echo $e->getMessage() . "\n" . $e->getTraceAsString();
}

