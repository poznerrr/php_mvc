<?php

declare(strict_types=1);

namespace Source\Views;

class UsersView extends View
{
    public function __construct(protected string $domain, protected array $users)
    {
        parent::__construct();
        $this->mainPath = dirname(__DIR__) . '/Layouts/users.phtml';
    }
}