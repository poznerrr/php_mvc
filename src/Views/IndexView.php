<?php

declare(strict_types=1);

namespace Source\Views;

class IndexView extends View
{
    public function __construct(protected string $domain, protected array $posts)
    {
        $this->headPath = dirname(__DIR__) . '/Layouts/head.phtml';
        $this->headerPath = dirname(__DIR__) . '/Layouts/header.phtml';
        $this->mainPath = dirname(__DIR__) . '/Layouts/index.phtml';
        $this->footerPath = dirname(__DIR__) . '/Layouts/footer.phtml';
        $this->templatePath = dirname(__DIR__) . '/Layouts/template.phtml';
    }
}

