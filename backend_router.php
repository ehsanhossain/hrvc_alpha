<?php
/**
 * Router script for PHP built-in web server (Backend).
 * Serves static files from backend/web/ and routes everything else through Yii2.
 */
$docRoot = __DIR__ . '/backend/web';
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$filePath = $docRoot . $uri;

// If the request is for an existing static file, serve it
if ($uri !== '/' && is_file($filePath)) {
    // Set correct content type for common file types
    $ext = pathinfo($filePath, PATHINFO_EXTENSION);
    $mimeTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'eot' => 'application/vnd.ms-fontobject',
        'json' => 'application/json',
        'map' => 'application/json',
    ];
    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
    }
    readfile($filePath);
    return true;
}

// Route through Yii2
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = $docRoot . '/index.php';
$_SERVER['DOCUMENT_ROOT'] = $docRoot;

require $docRoot . '/index.php';
