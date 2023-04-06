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
        $this->headPath = dirname(__DIR__) . '/Layouts/head.phtml';
        $this->headerPath = dirname(__DIR__) . '/Layouts/header.phtml';
        $this->footerPath = dirname(__DIR__) . '/Layouts/footer.phtml';
        $this->templatePath = dirname(__DIR__) . '/Layouts/template.phtml';
        switch ($postStatus) {
            case 'new':
                $this->mainPath = dirname(__DIR__) . '/Layouts/post.phtml';
                break;
            case 'success':
                $this->mainPath = dirname(__DIR__) . '/Layouts/postSuccess.phtml';
                break;
        }
    }
}