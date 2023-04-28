<?php

declare(strict_types=1);

namespace Source\Views;

class AuthorizationView extends View
{
    public function __construct(protected string $domain, protected string $keyStatus)
    {
        parent::__construct();
        $this->mainPath = dirname(__DIR__) . '/Layouts/authorization.phtml';
    }
}