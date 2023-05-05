<?php

declare(strict_types=1);

namespace Source\Views;

use Source\App\UriMaker;

class IndexView extends View
{
    public function __construct(
        protected string   $domain,
        protected array    $posts,
        protected int      $pageNumber,
        protected array    $paginatorPages,
        protected UriMaker $uriMaker)
    {
        parent::__construct();
        $this->mainPath = dirname(__DIR__) . '/Layouts/index.phtml';
    }
}

