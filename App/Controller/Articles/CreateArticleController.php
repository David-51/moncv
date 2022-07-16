<?php

// verify  $_POST

use App\Model\Entity\Articles;

if(!isset($_POST['title'], $_POST['content'])){
    echo json_encode(['message' => 'no enough parameters']);
    die();
}

$article = new Articles;
$article->setUniqId();
$article->setTitle($_POST['title']);
$article->setContent($_POST['content']);

$result = $article->persistEntity();

if(!$result) {
    echo json_encode(['message' => 'Error']);
}else {
    echo json_encode($article);
}