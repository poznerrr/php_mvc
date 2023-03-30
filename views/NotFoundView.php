<?php
declare(strict_types=1);

namespace views;

use app\lib\traits\TPageBuilder;

class NotFoundView
{
    use TPageBuilder;

    private string $header;

    private string $headerPath;

    private string $templatePath;

    public function __construct()
    {
        $this->headerPath = dirname(__DIR__) . '/layouts/header.html';
        $this->templatePath = dirname(__DIR__) . '/layouts/404.phtml';
    }
}