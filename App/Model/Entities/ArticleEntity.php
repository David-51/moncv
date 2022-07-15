<?php

namespace App\Model\Entity;

use App\Model\Manager\Entity;

class Article extends Entity
{
    private string $id;
    private string $title;
    private string $content;
    private string $picture_id;

    public function setTitle(string $title) :string {
        return $this->title = $title;
    }
    public function getTitle() :string {
        return $this->title;
    }
    public function setContent(string $content) :string {
        return $this->content = $content;
    }
    public function getContetnt () :string {
        return $this->content;
    }
    public function setPictureId(string $picture_id) :string {
        return $this->picture_id = $picture_id;
    }
    public function getPictureId() :string {
        return $this->picture_id;
    }
}