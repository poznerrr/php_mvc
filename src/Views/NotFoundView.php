<?php
declare(strict_types=1);

namespace Source\Views;

class NotFoundView extends View
{

    public function __construct(protected string $domain)
    {
        $this->headerPath = dirname(__DIR__) . '/Layouts/header.phtml';
        $this->templatePath = dirname(__DIR__) . '/Layouts/404.phtml';
    }
}