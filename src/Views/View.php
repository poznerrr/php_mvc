<?php

declare(strict_types=1);

namespace Source\Views;

abstract class View
{
    protected string $header;
    protected string $head;
    protected string $footer;
    protected string $main;
    protected string $templatePath;
    protected string $headerPath;
    protected string $headPath;
    protected string $footerPath;
    protected string $mainPath = '';


    public function __construct()
    {
        $this->headPath = dirname(__DIR__) . '/Layouts/head.phtml';
        $this->headerPath = dirname(__DIR__) . '/Layouts/header.phtml';
        $this->footerPath = dirname(__DIR__) . '/Layouts/footer.phtml';
        $this->templatePath = dirname(__DIR__) . '/Layouts/template.phtml';
    }

    protected function buildTemplate(string $templatePath): string
    {
        ob_start();
        require_once $templatePath;
        return ob_get_clean();
    }

    public function buildHTML(): string
    {
        $this->head = $this->buildTemplate($this->headPath);
        $this->header = $this->buildTemplate($this->headerPath);
        $this->footer = $this->buildTemplate($this->footerPath);
        $this->main = $this->buildTemplate($this->mainPath);
        return $this->buildTemplate($this->templatePath);
    }


}