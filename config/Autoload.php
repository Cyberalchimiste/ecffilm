<?php

spl_autoload_register(function ($class) {

    if (file_exists(_MODEL_ . 'bo/' . $class . '.php')) {
        require _MODEL_ . 'bo/' . $class . '.php';
    }
    if (file_exists(_MODEL_ . 'dal/' . $class . '.php')) {
        require _MODEL_ . 'dal/' . $class . '.php';
    }
});

// Load Twig autoloader
require_once 'vendor/autoload.php';
