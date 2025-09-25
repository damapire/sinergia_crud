<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$requested = __DIR__ . $uri;
if ($uri !== '/' && file_exists($requested) && is_file($requested)) {
    return false;
}
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF']   = '/index.php';
require __DIR__ . '/index.php';
