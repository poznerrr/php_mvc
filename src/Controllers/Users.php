<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\Models\UserService;

use Source\App\Registry;

use Source\Views\UsersView;

class Users extends Controller
{
    public array $users;
    public UserService $userService;

    public function __construct()
    {
        $this->userService = UserService::getInstance();
    }

    public function renderDefault(array $uriOptions = null): void
    {
        $this->users = $this->userService->getAllUsers();
        $view = (new UsersView(Registry::get('domain'), $this->users))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function delete(): void
    {
        if ($this->userService->deleteUserById((int)$_POST['id'])) {
            header("Location: /?controller=Users&action=renderDefault");
        }
    }

    public function updateUser(): void
    {
        if ($this->userService->updateUserById((int)$_POST['id'], $_POST['name'])) {
            header("Location: /?controller=Users&action=renderDefault");
        }
    }

}