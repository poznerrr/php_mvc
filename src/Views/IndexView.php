<?php

declare(strict_types=1);

namespace Source\Views;

use Source\App\Lib\Traits\TPageBuilder;

class IndexView
{
    use TPageBuilder;

    private string $header;

    private string $headerPath;

    private string $templatePath;


    public function __construct(private array $domainConfig, private array $posts)
    {
        $this->headerPath = dirname(__DIR__) . '/Layouts/header.phtml';
        $this->templatePath = dirname(__DIR__) . '/Layouts/index.phtml';
    }
}

