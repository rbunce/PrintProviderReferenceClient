<?php
if (!file_exists('config.php')) {
    echo 'Please copy config.php.dist to config.php and config settings';
    exit;
}

require_once 'config.php';

function autoloadPPRC($class)
{
    if (0 === strpos($class, 'PrintProviderReferenceClient_')) {
        $path = dirname(__FILE__) . '/../../src/'.implode('/', explode('_', $class)) . '.php';
        require_once $path;

        return true;
    }
}

spl_autoload_register('autoloadPPRC');