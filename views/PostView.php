<?php

namespace views;

use app\lib\traits\TPageBuilder;
use models\Post;

class PostView
{
    use TPageBuilder;

    private string $header;

    private string $headerPath;

    private string $templatePath;

    private array|null $categories;

    private array|null $users;

    public function __construct(string $postStatus, array|null $categories, array|null $users)
    {
        $this->categories = $categories;
        $this->users = $users;

        switch ($postStatus) {
            case 'new':
                $this->categories = $categories;
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