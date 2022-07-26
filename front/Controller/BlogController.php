<?php

use App\Model\Entity\Articles;
use Controller\Template;

if(isset($_GET['page']) && is_numeric($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}

$articles = new Articles;
$results = $articles->getArticles($page, 10);

$blog = new Template;
$blog->setHeader('Header', ['link' => '/']);
$blog->setBody('Blog', $results);
$blog->setFooter('Footer');
echo $blog->getContent('Template');
