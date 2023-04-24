<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\Registry;
use Source\Models\UserService;
use Source\Views\RegistrationView;

class Registration extends Controller
{
    public UserService $userService;

    public function __construct()
    {
        $this->userService = UserService::getInstance();
    }

    public function render(array $uriOptions = null): void
    {
        $view = (new RegistrationView(Registry::get('domain'), 'new'))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function register(): void
    {
        if (isset($_POST["user-name"])) {
            $this->userService->createUser($_POST['user-name']);
            $view = (new RegistrationView(Registry::get('domain'), 'success'))->buildHTML();
            $this->showOnMonitor($view);
        }

    }
}