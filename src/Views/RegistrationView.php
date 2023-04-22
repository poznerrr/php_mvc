<?php

declare(strict_types=1);

namespace Source\Views;

class RegistrationView extends View
{
    public function __construct(protected string $domain, string $registrationStatus)
    {
        parent::__construct();
        switch ($registrationStatus) {
            case 'new':
                $this->mainPath = dirname(__DIR__) . '/Layouts/registration.phtml';
                break;
            case 'success':
                $this->mainPath = dirname(__DIR__) . '/Layouts/registerSuccess.phtml';
                break;
        }
    }
}