<?php

use Assets\Autoloader;
use Assets\CleanArray;
use Assets\PathLoader;

require './front/Assets/PathLoaderAssets.php';
PathLoader::registerPath();
Autoloader::register();
CleanArray::Clean($_GET);

// router