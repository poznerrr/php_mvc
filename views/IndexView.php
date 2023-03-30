<?php
declare(strict_types=1);

namespace views;

use app\lib\traits\TPageBuilder;

class IndexView
{
    use TPageBuilder;

    private array $posts;
    private string $header;

    private string $headerPath;

    private string $templatePath;


    public function __construct(array $posts)
    {
        $this->posts = $posts;
        $this->headerPath = dirname(__DIR__) . '/layouts/header.html';
        $this->templatePath = dirname(__DIR__) . '/layouts/index.phtml';

    }
}

