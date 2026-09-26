<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Folder sementara yang dapat ditulis oleh fungsi Vercel.
$storagePath = '/tmp/gki-laravel';

$directories = [
    $storagePath,
    $storagePath . '/app',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/views',
    $storagePath . '/logs',
];

foreach ($directories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }
}

// Cache internal Laravel diarahkan ke folder sementara.
$temporaryPaths = [
    'APP_SERVICES_CACHE' => $storagePath . '/services.php',
    'APP_PACKAGES_CACHE' => $storagePath . '/packages.php',
    'APP_CONFIG_CACHE' => $storagePath . '/config.php',
    'APP_ROUTES_CACHE' => $storagePath . '/routes.php',
    'APP_EVENTS_CACHE' => $storagePath . '/events.php',
    'VIEW_COMPILED_PATH' => $storagePath . '/framework/views',
];

foreach ($temporaryPaths as $name => $value) {
    putenv($name . '=' . $value);
    $_ENV[$name] = $value;
    $_SERVER[$name] = $value;
}

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath($storagePath);

// URL aset dan link Laravel memakai HTTPS di Vercel.
$app->booted(function () use ($app) {
    $app['url']->forceScheme('https');
});

$app->handleRequest(Request::capture());