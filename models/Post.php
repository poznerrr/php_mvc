<?php

namespace models;

class Post
{
    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    private $title;

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    private $date;

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    private $text;

    public function getText()
    {
        return $this->text;
    }

    public function setText($text): void
    {
        $this->text = $text;
    }

    private $author;

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author): void
    {
        $this->author = $author;
    }


}