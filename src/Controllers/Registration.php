<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{Registry, Request};
use Source\Models\UserService;
use Source\Views\RegistrationView;

class Registration extends ControllerHTTP
{

    public function __construct()
    {
    }

    public function get(Request $req): void
    {
        $keyStatus = $req->getParam('keyStatus') ?? 'new';
        $view = (new RegistrationView(Registry::get('domain'), $keyStatus))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function register(Request $req, UserService $userService): void
    {
        if (($req->getParam('user-name') !== null) && ($req->getParam('user-password') !== null)) {
            $password = password_hash($req->getParam('user-password'), PASSWORD_BCRYPT);
            $userService->createUser($req->getParam('user-name'), $password);
            $currentUser = $userService->getUserByName($req->getParam('user-name'));
            setcookie('authorizeId', "{$currentUser->getId()}", time() + 3600 * 24, '/');
            setcookie('authorizePassword', "{$currentUser->getPassword()}", time() + 3600 * 24, '/');
            Registry::set('userName', $currentUser->getName());
            Registry::set('userId', $currentUser->getId());
            $view = (new RegistrationView(Registry::get('domain'), 'success'))->buildHTML();
            $this->showOnMonitor($view);
        }
    }
}