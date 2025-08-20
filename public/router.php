<?php
// Serve existing files as-is (CSS/JS/images, etc.)
$path = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (is_file($path)) {
    return false; // let the built-in server handle it
}

// Otherwise, bootstrap the app through your front controller
require __DIR__ . '/index.php';
