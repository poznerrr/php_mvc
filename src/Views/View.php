<?php

declare(strict_types=1);

namespace Source\Views;

abstract class View
{
    protected string $header;
    protected string $head;
    protected string $footer;
    protected string $main;


    public function __construct(protected string $templatePath,
                                protected string $headerPath,
                                protected string $mainPath,
                                protected string $headPath,
                                protected string $footerPath)
    {
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