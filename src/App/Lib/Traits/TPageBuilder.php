<?php

declare(strict_types=1);

namespace Source\App\Lib\Traits;

trait TPageBuilder
{
    public function buildTemplate(string $templatePath): string
    {
        ob_start();
        require_once $templatePath;
        return ob_get_clean();
    }

    public function build(): void
    {
        $this->header = $this->buildTemplate($this->headerPath);
        echo $this->buildTemplate($this->templatePath);
    }
}