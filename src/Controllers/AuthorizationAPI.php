<?php
declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{DtoValidator, JwtHandler, Request};
use Source\Models\DTO\{AuthorizeDto, ErrorDto, LoginDataDto};
use Source\Models\User;
use Source\Models\UserService;

class AuthorizationAPI extends ControllerAPI
{
    private ?User $currentUser;

    public function __construct()
    {
    }

    public function login(Request $req, UserService $userService): void
    {
        if (!DtoValidator::checkValidation($req, LoginDataDto::class)) {
            $this->returnAnswer(new ErrorDto('Incorrect data'));
            exit();
        }
        $incomeDto = new LoginDataDto($req);
        [$isValid, $keyStatus, $this->currentUser] = Authorization::validation($incomeDto->userName, $incomeDto->userPassword, $userService);
        if (!$isValid) {
            $outcomeDto = new ErrorDto($keyStatus);
        } else {
            $jwt = JwtHandler::makeJWT($this->currentUser->getId());
            $outcomeDto = new AuthorizeDto($jwt);
        }
        $this->returnAnswer($outcomeDto);
    }
}
