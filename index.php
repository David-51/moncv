<?php

use Assets\Autoloader;
use Assets\CleanArray;
use Assets\PathLoader;

require './Front/Assets/PathLoaderAssets.php';
require './Front/Assets/Autoloader.php';

PathLoader::registerPath();
Autoloader::register();
CleanArray::Clean($_GET);

// router
switch ($_GET) {
    case 'blog':
        break;
    case 'cv':
        break;
    default:

}