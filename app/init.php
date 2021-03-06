<?php
define('KWN_ROOT', dirname(__DIR__));
define('KWN_APP_ROOT', dirname(__DIR__) . '/app/');
# composer
require_once KWN_ROOT . '/vendor/autoload.php';
//\Illuminate\Support\ClassLoader::register();
//\Illuminate\Support\ClassLoader::addDirectories(['controllers', 'models', 'core', 'views']);
# db config
require_once KWN_APP_ROOT . 'database.php';
# app
require_once KWN_APP_ROOT . 'core/App.php';
# controller
require_once KWN_APP_ROOT . 'core/Controller.php';
