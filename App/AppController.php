<?php
// App routeur
use App\Assets\CleanArray;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

$_POST = CleanArray::Clean($_POST);

switch ($_GET['level2']) {
    case 'createArticle':
        require 'CreateArticleController.php';
        break;
    case 'articles':
        require 'GetArticlesController.php';
        break;
    case 'messages':
        require 'MessagesController.php';
        break;
    default :
        echo json_encode(['message' => 'You must specify a valid route']);
}