<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Pedallica - Production Entry Point
|--------------------------------------------------------------------------
| Dit bestand is aangepast voor FutureWeb hosting.
| Laravel applicatie staat in: ../laravel-app/
| Webroot (public_html) bevat alleen publieke bestanden.
|--------------------------------------------------------------------------
*/

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../laravel-app/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../laravel-app/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../laravel-app/bootstrap/app.php';

$app->handleRequest(Request::capture());
