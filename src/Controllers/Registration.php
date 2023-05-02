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

    public function renderDefault(array $uriOptions = null): void
    {
        if (!isset($uriOptions['keyStatus'])) {
            $uriOptions['keyStatus'] = 'new';
        }
        $view = (new RegistrationView(Registry::get('domain'), $uriOptions['keyStatus']))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function register(): void
    {
        if (isset($_POST["user-name"]) && isset($_POST["user-password"])) {
            $saltedPassword = password_hash($_POST['user-password'], PASSWORD_BCRYPT);
            $this->userService->createUser($_POST['user-name'], $saltedPassword);
            $view = (new RegistrationView(Registry::get('domain'), 'success'))->buildHTML();
            $this->showOnMonitor($view);
        }
    }
}