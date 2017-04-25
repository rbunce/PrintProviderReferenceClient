<?php
if (!file_exists(__DIR__ . '/config.php')) {
    echo 'Please copy config.php.dist to config.php and config settings';
    exit;
}

require_once 'config.php';
require_once 'autoloader.php';
