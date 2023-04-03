<?php

declare(strict_types=1);

namespace Source\Views;

class IndexView extends View
{
    public function __construct(protected array $domainConfig, protected array $posts)
    {
        $this->headerPath = dirname(__DIR__) . '/Layouts/header.phtml';
        $this->templatePath = dirname(__DIR__) . '/Layouts/index.phtml';
    }
}

