<?php
declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{JwtHandler, Request};
use Source\Models\DTO\{AuthorizeDto, ErrorDto, LoginDataDto};
use Source\Models\User;

class AuthorizationAPI extends ControllerAPI
{
    private ?User $currentUser;

    public function __construct()
    {
    }

    public function login(Request $req): void
    {
        $incomeDto = new LoginDataDto($req);
        if (!$incomeDto->isValid) {
            $outcomeDto = new ErrorDto('Bad parameters');
        } else {
            list($isValid, $keyStatus, $this->currentUser) = Authorization::validation($incomeDto->userName, $incomeDto->userPassword);
            if (!$isValid) {
                $outcomeDto = new ErrorDto($keyStatus);
            } else {
                $jwt = JwtHandler::makeJWT($this->currentUser->getId());
                $outcomeDto = new AuthorizeDto($jwt);
            }
        }
        $this->returnAnswer($outcomeDto);
    }
}
