<?php

namespace App\Model\Entity;

class Article extends Entities
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
}