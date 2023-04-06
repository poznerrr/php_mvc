<?php
declare(strict_types=1);

namespace Source\Views;

class NotFoundView extends View
{

    public function __construct(protected string $domain)
    {
        parent::__construct();
        $this->mainPath = dirname(__DIR__) . '/Layouts/404.phtml';
    }
}