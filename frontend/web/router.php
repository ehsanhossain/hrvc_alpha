<?php
/**
 * Router script for Yii2 frontend with PHP built-in development server.
 * Handles pretty URLs by forwarding non-file requests to index.php.
 */
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = __DIR__ . $uri;

// If it's a real file, let PHP serve it directly (CSS, JS, images, etc.)
if ($uri !== '/' && is_file($path)) {
    return false;
}

// Forward everything else to index.php (Yii2 handles routing)
// Fix the server vars so Yii2 can determine the entry script correctly
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/index.php';
$_SERVER['PHP_SELF'] = '/index.php' . $uri;

require __DIR__ . '/index.php';
