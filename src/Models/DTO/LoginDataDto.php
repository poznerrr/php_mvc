<?php
declare(strict_types=1);

namespace Source\Models\DTO;

use Source\App\Request;

class LoginDataDto
{
    public string $userName;
    public string $userPassword;

    public function __construct(Request $req)
    {
        $this->userName = $req->getParam('userName');
        $this->userPassword = $req->getParam('userPassword');
    }
}