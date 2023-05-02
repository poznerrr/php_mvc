<?php
declare(strict_types=1);

namespace Source\App;

use Source\Models\UserService;

class AuthorizationChecker
{


    public static function checkAuthorization(): void
    {
        if (isset($_COOKIE['id']) && isset($_COOKIE['password'])) {
            $desireUser = UserService::getInstance()->getUserById($_COOKIE['id']);
            if ($desireUser->getPassword() === $_COOKIE['password']) {
                Registry::set('userId', $desireUser->getId());
                Registry::set('userName', $desireUser->getName());
            } else {
                setcookie('id', '', time());
                setcookie('password', '', time());
            }
        }
    }
}