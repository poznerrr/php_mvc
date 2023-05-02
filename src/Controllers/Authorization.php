<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\Registry;
use Source\Models\UserService;
use Source\Views\AuthorizationView;

class Authorization extends Controller
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
        $view = (new AuthorizationView(Registry::get('domain'), $uriOptions['keyStatus']))->buildHTML();
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
                setcookie('id', "{$desiredUser->getId()}", time() + 3600 * 24);
                setcookie('password', "{$desiredUser->getPassword()}", time() + 3600 * 24);

            } else {
                $keyStatus = 'wrongData';
            }
        }

        $uriOptions['keyStatus'] = $keyStatus;
        $this->renderDefault($uriOptions);
    }

    public function logout(): void
    {
        setcookie('id', '', time());
        setcookie('password', '', time());
        header("Location: /?controller=Authorization&action=renderDefault");
    }

}