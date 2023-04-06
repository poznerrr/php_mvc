<?php
declare(strict_types=1);

namespace Source\Views;

class NotFoundView extends View
{

    public function __construct(protected string $domain)
    {
        $this->headPath = dirname(__DIR__) . '/Layouts/head.phtml';
        $this->headerPath = dirname(__DIR__) . '/Layouts/header.phtml';
        $this->mainPath = dirname(__DIR__) . '/Layouts/404.phtml';
        $this->footerPath = dirname(__DIR__) . '/Layouts/footer.phtml';
        $this->templatePath = dirname(__DIR__) . '/Layouts/template.phtml';
    }
}