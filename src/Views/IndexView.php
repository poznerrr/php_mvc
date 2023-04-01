<?php
declare(strict_types=1);

namespace Source\Views;

use Source\App\Lib\Traits\TPageBuilder;

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
        $this->headerPath = dirname(__DIR__) . '/Layouts/header.html';
        $this->templatePath = dirname(__DIR__) . '/Layouts/index.phtml';

    }
}

