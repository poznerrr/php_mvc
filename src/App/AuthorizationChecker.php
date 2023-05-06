<?php
declare(strict_types=1);

namespace Source\App;

use Source\Models\UserService;

class AuthorizationChecker
{


    public static function checkAuthorization(): void
    {
        try {
            if (isset($_COOKIE['authorizeId']) && isset($_COOKIE['authorizePassword'])) {
                $desireUser = UserService::getInstance()->getUserById($_COOKIE['authorizeId']);
                if ($desireUser->getPassword() === $_COOKIE['authorizePassword']) {
                    Registry::set('userId', $desireUser->getId());
                    Registry::set('userName', $desireUser->getName());
                } else {
                    setcookie('authorizeId', '', time(), '/');
                    setcookie('authorizePassword', '', time(), '/');
                }
            }
        } /*Если вдруг попалась кука непонятного происхождения*/
        catch (\Error) {
            setcookie('authorizeId', '', time(), '/');
            setcookie('authorizePassword', '', time(), '/');
        }
    }
}