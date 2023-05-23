<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{AuthorizationChecker, Registry, Request};
use Source\Models\UserService;
use Source\Views\AuthorizationView;

class Authorization extends ControllerHTTP
{

    public function __construct()
    {
    }

    public function get(Request $req): void
    {
        $keyStatus = $req->getParam('keyStatus') ?? 'new';
        $view = (new AuthorizationView(Registry::get('domain'), $keyStatus))->buildHTML();
        $this->showOnMonitor($view);

    }

    public static function validation(string $name, string $password, UserService $userService): array
    {
        $desiredUser = $userService->getUserByName($name);
        if (!isset($desiredUser)) {
            $isValid = false;
            $keyStatus = 'notFoundUser';
            $desiredUser = null;
        } else {
            if (password_verify($password, $desiredUser->getPassword())) {
                $isValid = true;
                $keyStatus = 'success';
            } else {
                $isValid = false;
                $keyStatus = 'wrongData';
                $desiredUser = null;
            }
        }
        return [$isValid, $keyStatus, $desiredUser];
    }

    public function authorize(Request $req, UserService $userService): void
    {
        list($isValid, $keyStatus, $currentUser) = Authorization::validation($req->getParam('user-name'), $req->getParam('user-password'), $userService);
        if ($isValid) {
            setcookie('authorizeId', "{$currentUser->getId()}", time() + 3600 * 24, '/');
            setcookie('authorizePassword', "{$currentUser->getPassword()}", time() + 3600 * 24, '/');
            Registry::set('userName', $currentUser->getName());
            Registry::set('userId', $currentUser->getId());
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