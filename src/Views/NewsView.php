<?php

declare(strict_types=1);

namespace Source\Views;

use Source\App\UriMaker;
use Source\Models\Post;

class NewsView extends View
{
    public function __construct(protected string $domain, protected Post $post, protected  array $similarNews, protected UriMaker $uriMaker)
    {
        parent::__construct();
        $this->mainPath = dirname(__DIR__) . '/Layouts/news.phtml';
    }
}