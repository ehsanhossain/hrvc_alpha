<?php
/**
 * Router script for PHP built-in server
 * Mimics .htaccess rewrite: /financial/FinancialDashboard -> /financial/FinancialDashboard.php
 */
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// If the file exists as-is, serve it
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    if (is_file(__DIR__ . $uri)) {
        // Check if it's a PHP file that needs execution
        if (pathinfo($uri, PATHINFO_EXTENSION) === 'php') {
            chdir(dirname(__DIR__ . $uri));
            include __DIR__ . $uri;
            return true;
        }
        return false; // Let PHP built-in server handle static files
    }
}

// Try adding .php extension
$phpFile = __DIR__ . $uri . '.php';
if (file_exists($phpFile) && is_file($phpFile)) {
    chdir(dirname($phpFile));
    include $phpFile;
    return true;
}

// Try index.php in directory
$dirPath = rtrim($uri, '/');
$indexFile = __DIR__ . $dirPath . '/index.php';
if (file_exists($indexFile)) {
    chdir(dirname($indexFile));
    include $indexFile;
    return true;
}

// Default: serve index.php at root
if ($uri === '/') {
    chdir(__DIR__);
    include __DIR__ . '/index.php';
    return true;
}

// Fallback
return false;
