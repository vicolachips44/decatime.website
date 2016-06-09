<?php

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    // not serving a php file
    return false;
}

require __DIR__.'/../config/bootstrap.php';
