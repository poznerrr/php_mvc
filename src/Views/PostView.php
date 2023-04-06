<?php

declare(strict_types=1);

namespace Source\Views;

class PostView extends View
{
    public function __construct(
        protected string $domain,
        protected string $postStatus,
        protected array|null $categories,
        protected array|null $users
    ) {
        switch ($postStatus) {
            case 'new':
                $this->headerPath = dirname(__DIR__) . '/Layouts/header.phtml';
                $this->templatePath = dirname(__DIR__) . '/Layouts/post.phtml';
                break;
            case 'success':
                $this->headerPath = dirname(__DIR__) . '/Layouts/header.phtml';
                $this->templatePath = dirname(__DIR__) . '/Layouts/postSuccess.phtml';
                break;
        }
    }
}