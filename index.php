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
$_GET = CleanArray::Clean($_GET);

// Load phpdotenv to read .env
require 'vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// router
switch ($_GET['level1']) {
    case 'blog':
        Logger::setMessage('Visit Blog');
        require 'BlogController.php';
        break;
    case 'cv':
        Logger::setMessage('Visit CV');
        require 'CVController.php';
        break;
    case 'admin':
        break;
    case 'app':
        require 'AppController.php';
        break;
    default:
        Logger::setMessage('connect to Home');        
        require 'HomeController.php';        
}