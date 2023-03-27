<?php

namespace views;

class IndexView
{
    private $posts;
    public function __construct($posts)
    {
        $this->posts = $posts;
        require dirname(__DIR__) . '/layouts/index.phtml';
    }

}