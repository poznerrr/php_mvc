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

    public function render(array $uriOptions = null): void
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
            $saltedPassword = md5($password . $desiredUser->getSalt());
            if ($saltedPassword === $desiredUser->getPassword()) {
                $keyStatus = 'success';
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $desiredUser->getId();
                $_SESSION['login'] = $desiredUser->getName();
            } else {
                $keyStatus = 'wrongData';
            }
        }

        $uriOptions['keyStatus'] = $keyStatus;
        $this->render($uriOptions);
    }

    public function logout(): void
    {
        unset($_SESSION['auth']);
        unset($_SESSION['id']);
        unset($_SESSION['login']);
        $uriOptions['keyStatus'] = 'new';
        $this->render($uriOptions);
    }

}