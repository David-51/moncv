<?php

namespace App\Model\Entity;

use App\Model\Manager\Entity;

class Articles extends Entity
{
    public string $id;
    public string $title;
    public string $content;
    public string $picture_id;

    public function setTitle(string $title) :string {
        return $this->title = $title;
    }
    public function getTitle() :string {
        return $this->title;
    }
    public function setContent(string $content) :string {
        return $this->content = $content;
    }
    public function getContent () :string {
        return $this->content;
    }
    public function setPictureId(string $picture_id) :string {
        return $this->picture_id = $picture_id;
    }
    public function getPictureId() :string {
        return $this->picture_id;
    }
    public function getArticles(int $page, int $limit) :array|bool {        
        $offset = ($page - 1) * $limit;
        
        $query = "SELECT articles.*, pictures.link AS picture_link, pictures.name AS picture_name FROM articles JOIN pictures ON pictures.id = articles.picture_id ORDER BY articles.date DESC LIMIT $limit OFFSET $offset";
        return $this->getWithQuery($query, true);
    }
    public function getArticle() :Entity|bool {
        $id = $this->getId();
        $query = "SELECT articles.*, pictures.link AS picture_link, pictures.name AS picture_name FROM articles JOIN pictures ON pictures.id = articles.picture_id WHERE articles.id = \'$id\'";
        return $this->getWithQuery($query);
    }
}