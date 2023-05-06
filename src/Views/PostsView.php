<?php

declare(strict_types=1);

namespace Source\Views;

class PostsView extends View
{
    public function __construct(
        protected string $domain,
        protected array $posts,
        protected int $pageNumber,
        protected array $paginatorPages,
        protected array $categories,
        protected array $users
    ) {
        parent::__construct();
        $this->mainPath = dirname(__DIR__) . '/Layouts/posts.phtml';
    }
}