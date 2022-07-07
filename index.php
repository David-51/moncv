<?php

use Assets\Autoloader;
use Assets\CleanArray;
use Assets\Logger;
use Assets\PathLoader;
use Dotenv\Dotenv;

require './Front/Assets/PathLoaderAssets.php';
require './Front/Assets/Autoloader.php';

PathLoader::registerPath();
Autoloader::register();
CleanArray::Clean($_GET);

require 'vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// router
switch ($_GET['level1']) {
    case 'blog':        
        Logger::setMessage('Blog');
        break;
    case 'cv':
        break;
    case 'admin':
        break;
    default:
        require 'HomeController.php';        
}