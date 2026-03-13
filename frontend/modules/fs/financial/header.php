<?php
/**
 * Shim header.php for Yii2 integration.
 * The real header (nav, sidebar) is provided by Yii2's main.php layout.
 * This file just sets up the PHP variables and includes that FS pages expect.
 */
@session_start();
include(__DIR__ . "/../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

// The FS pages check $currentUrl for active menu highlighting
$currentUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!-- FS page body content begins (inside Yii2 layout) -->
<div class="fs-wrapper">
