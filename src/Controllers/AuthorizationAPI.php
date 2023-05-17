<?php
declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{JwtHandler, Request};
use Source\Models\DTO\{AuthorizeDto, ErrorDto};
use Source\Models\User;

class AuthorizationAPI extends ControllerAPI
{
    private ?User $currentUser;
    public function __construct()
    {
    }

    public function login(Request $req): void
    {
        $name = $req->getParam('userName');
        $password = $req->getParam('userPassword');
        list($isValid, $keyStatus, $this->currentUser) = Authorization::validation($name, $password);
        if (!$isValid) {
            $dto = new ErrorDto($keyStatus);
        } else {
            $jwt = JwtHandler::makeJWT($this->currentUser->getId());
            $dto = new AuthorizeDto($jwt);
        }
        $this->returnAnswer($dto);
    }
}
