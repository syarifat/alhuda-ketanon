<?php

// Vercel Serverless Function Entry Point for Laravel
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$storagePath = '/tmp/storage';
$directories = [
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/logs',
    '/tmp/bootstrap/cache',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Copy pre-built bootstrap caches to /tmp so they can be read/written
if (!file_exists('/tmp/bootstrap/cache/packages.php') && file_exists(__DIR__ . '/../bootstrap/cache/packages.php')) {
    @copy(__DIR__ . '/../bootstrap/cache/packages.php', '/tmp/bootstrap/cache/packages.php');
}
if (!file_exists('/tmp/bootstrap/cache/services.php') && file_exists(__DIR__ . '/../bootstrap/cache/services.php')) {
    @copy(__DIR__ . '/../bootstrap/cache/services.php', '/tmp/bootstrap/cache/services.php');
}

putenv('LARAVEL_STORAGE_PATH=' . $storagePath);
$_ENV['LARAVEL_STORAGE_PATH'] = $storagePath;
$_SERVER['LARAVEL_STORAGE_PATH'] = $storagePath;

putenv('VIEW_COMPILED_PATH=' . $storagePath . '/framework/views');
$_ENV['VIEW_COMPILED_PATH'] = $storagePath . '/framework/views';
$_SERVER['VIEW_COMPILED_PATH'] = $storagePath . '/framework/views';

putenv('APP_SERVICES_CACHE=' . '/tmp/bootstrap/cache/services.php');
putenv('APP_PACKAGES_CACHE=' . '/tmp/bootstrap/cache/packages.php');
putenv('APP_CONFIG_CACHE=' . '/tmp/bootstrap/cache/config.php');
putenv('APP_ROUTES_CACHE=' . '/tmp/bootstrap/cache/routes.php');
putenv('APP_EVENTS_CACHE=' . '/tmp/bootstrap/cache/events.php');

require __DIR__ . '/../public/index.php';

