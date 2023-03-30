<?php

namespace views;

use app\lib\traits\TPageBuilder;

class PostView
{
    use TPageBuilder;

    private string $header;

    private string $headerPath;

    private string $templatePath;

    public function __construct($postStatus)
    {
        switch ($postStatus) {
            case 'new':
                $this->headerPath = dirname(__DIR__) . '/layouts/header.html';
                $this->templatePath = dirname(__DIR__) . '/layouts/post.phtml';
                break;
            case 'success':
                $this->headerPath = dirname(__DIR__) . '/layouts/header.html';
                $this->templatePath = dirname(__DIR__) . '/layouts/postSuccess.phtml';
                break;
        }
    }
}