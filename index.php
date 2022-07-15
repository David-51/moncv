<?php

use App\Assets\Autoloader;
use App\Assets\CleanArray;
use App\Assets\Logger;
use App\Assets\PathLoader;
use Dotenv\Dotenv;

require './App/Assets/PathLoaderAssets.php';
require './App/Assets/Autoloader.php';

PathLoader::registerPath();
Autoloader::register();
CleanArray::Clean($_GET);

// Load phpdotenv to read .env
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
        Logger::setMessage('connect to Home');
        require 'HomeController.php';        
}