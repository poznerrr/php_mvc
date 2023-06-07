<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\Models\UserService;

use Source\App\{Registry, Request};

use Source\Views\UsersView;

class Users extends ControllerHTTP
{
    public array $users;

    public function __construct()
    {
    }

    public function get(Request $req, UserService $userService): void
    {
        $this->users = $userService->getAllUsers();
        $view = (new UsersView(Registry::get('domain'), $this->users))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function delete(Request $req, UserService $userService): void
    {
        if ($userService->deleteUserById($req->getIntParam('id'))) {
            header("Location: /users");
        }
    }

    public function updateUser(Request $req, UserService $userService): void
    {
        if ($userService->updateUserById($req->getIntParam('id'), $req->getParam('name'))) {
            header("Location: /users");
        }
    }

}