<?php

use App\Model\Entity\Articles;

if(isset($_GET['page']) && is_numeric($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$articles = new Articles;
$response = $articles->getArticles($page, 10);

if(is_array($response)){
    echo json_encode($response);
}else{
    echo json_encode(['message' => 'error getting articles']);
}
