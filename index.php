<?php

use Assets\Autoloader;
use Assets\CleanArray;
use Assets\Logger;
use Assets\PathLoader;

require './Front/Assets/PathLoaderAssets.php';
require './Front/Assets/Autoloader.php';

PathLoader::registerPath();
Autoloader::register();
CleanArray::Clean($_GET);

// router
switch ($_GET) {
    case 'blog':
        Logger::setMessage('Blog');
        break;
    case 'cv':
        break;
    default:

}