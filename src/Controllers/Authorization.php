<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{AuthorizationChecker, Registry, Request};
use Source\Models\UserService;
use Source\Views\AuthorizationView;

class Authorization extends Controller
{
    public UserService $userService;

    public function __construct()
    {
        $this->userService = UserService::getInstance();
    }

    public function renderDefault(Request $req): void
    {
        $keyStatus = $req->getParam('keyStatus') ?? 'new';
        $view = (new AuthorizationView(Registry::get('domain'), $keyStatus))->buildHTML();
        $this->showOnMonitor($view);

    }

    public function authorize(): void
    {
        $desiredUser = $this->userService->getUserByName($_POST['user-name']);
        if (!isset($desiredUser)) {
            $keyStatus = 'notFoundUser';
        } else {
            $password = $_POST['user-password'];
            if (password_verify($password, $desiredUser->getPassword())) {
                $keyStatus = 'success';
                setcookie('authorizeId', "{$desiredUser->getId()}", time() + 3600 * 24, '/');
                setcookie('authorizePassword', "{$desiredUser->getPassword()}", time() + 3600 * 24, '/');
            } else {
                $keyStatus = 'wrongData';
            }
        }
        $view = (new AuthorizationView(Registry::get('domain'), $keyStatus))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function logout(): void
    {
        setcookie('authorizeId', '', time(), '/');
        setcookie('authorizePassword', '', time(), '/');
        header("Location: /Authorization");
    }

}