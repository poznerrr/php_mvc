<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{Registry, Request};
use Source\Models\UserService;
use Source\Views\RegistrationView;

class Registration extends Controller
{
    public UserService $userService;

    public function __construct()
    {
        $this->userService = UserService::getInstance();
    }

    public function renderDefault(Request $req): void
    {
        $keyStatus = $req->getParam('keyStatus') ?? 'new';
        $view = (new RegistrationView(Registry::get('domain'), $keyStatus))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function register(): void
    {
        if (isset($_POST["user-name"]) && isset($_POST["user-password"])) {
            $password = password_hash($_POST['user-password'], PASSWORD_BCRYPT);
            $this->userService->createUser($_POST['user-name'], $password);
            $desiredUser = $this->userService->getUserByName($_POST['user-name']);
            setcookie('id', "{$desiredUser->getId()}", time() + 3600 * 24);
            setcookie('password', "{$desiredUser->getName()}", time() + 3600 * 24);
            $view = (new RegistrationView(Registry::get('domain'), 'success'))->buildHTML();
            $this->showOnMonitor($view);
        }
    }
}