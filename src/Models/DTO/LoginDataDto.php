<?php
declare(strict_types=1);

namespace Source\Models\DTO;

use Source\App\Request;

class LoginDataDto
{
    public string $userName;
    public string $userPassword;
    public bool $isValid = false;

    public function __construct(Request $req)
    {
        if ($req->getParam('userName') && $req->getParam('userPassword')) {
            $this->isValid = true;
            $this->userName = $req->getParam('userName');
            $this->userPassword = $req->getParam('userPassword');
        }
    }
}