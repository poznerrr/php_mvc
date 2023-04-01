<?php
declare(strict_types=1);

namespace Source\Views;

use Source\App\Lib\Traits\TPageBuilder;

class NotFoundView
{
    use TPageBuilder;

    private string $header;

    private string $headerPath;

    private string $templatePath;

    public function __construct()
    {
        $this->headerPath = dirname(__DIR__) . '/Layouts/header.html';
        $this->templatePath = dirname(__DIR__) . '/Layouts/404.phtml';
    }
}