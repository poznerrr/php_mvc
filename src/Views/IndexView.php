<?php

declare(strict_types=1);

namespace Source\Views;

class IndexView extends View
{
    public function __construct(protected string $domain, protected array $posts)
    {
        parent::__construct();
        $this->mainPath = dirname(__DIR__) . '/Layouts/index.phtml';
    }
}

