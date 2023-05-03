<?php

declare(strict_types=1);

namespace Source\Views;

class AuthorizationView extends View
{
    protected string $authorizationMessage;

    public function __construct(protected string $domain, protected string $keyStatus)
    {
        parent::__construct();
        $this->mainPath = dirname(__DIR__) . '/Layouts/authorization.phtml';
        switch ($this->keyStatus) {
            case "success":
            {
                $this->authorizationMessage = "Вы успешно авторизованы";
                break;
            }
            case "notFoundUser":
            {
                $this->authorizationMessage = "Пользователь не найден";
                break;
            }
            case "wrongData":
            {
                $this->authorizationMessage = "Неверно введён пароль";
                break;
            }
            default:
            {
                $this->authorizationMessage = "";
                break;
            }
        }
    }
}