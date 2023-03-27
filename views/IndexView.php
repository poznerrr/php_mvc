<?php

namespace views;

class IndexView
{
    private array $posts;
    public function __construct(array $posts)
    {
        $this->posts = $posts;
        require dirname(__DIR__) . '/layouts/index.phtml';
    }

}