<?php
// Serve existing files as-is (CSS/JS/images, etc.)
// _SERVER['REQUEST_URI'] contains info about the current HTTP request.
// REQUEST_URI is the part of the URL after your domain/host.
// The parse_url function can break a URL into its parts. PHP_URL_PATH extracts just the path part of the URL.
// __DIR__ This is a magic constant in PHP. It gives you the full filesystem path to the folder this script lives in.

// $path = __DIR__ . parse_url(...); This builds the absolute path to the requested file on your hard drive.

$path = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// is_file($path) checks if that path is a real file on disk.
// If it is (for example, logo.png exists): The script returns false.
// Returning false in a PHP built-in server router tells the server:
// “Don’t run my app code—just serve that file as a static file.”
// This way, CSS, JS, images, etc. are delivered directly, without going through your app logic.
if (is_file($path)) {
    return false; // let the built-in server handle it
}

// If the requested path was not an existing file, then it must be a “route” in your MVC app.
// So we load (require) your main entry point: index.php in the same folder.
// That index.php is your “front controller”—it bootstraps your app, loads the router, controllers, etc.
require __DIR__ . '/index.php';
