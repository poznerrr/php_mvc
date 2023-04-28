<?php

declare(strict_types=1);

namespace Source\Views;

use Source\Models\Post;

class NewsView extends View
{
    public function __construct(protected string $domain, protected Post $post)
    {
        parent::__construct();
        $this->mainPath = dirname(__DIR__) . '/Layouts/news.phtml';
    }
}