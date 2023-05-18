<?php
declare(strict_types=1);

namespace Source\Models\DTO;

use Source\App\Request;


class GettingByIdDto
{
    public string $authorizeString;
    public string $id;
    public bool $isValid = false;

    public function __construct(Request $req)
    {
        if ($req->getParam('HTTP_AUTHORIZATION') && $req->getParam('postId')) {
            $this->isValid = true;
            $this->id =$req->getParam('postId');
            $this->authorizeString = $req->getParam('HTTP_AUTHORIZATION');
        }
    }
}