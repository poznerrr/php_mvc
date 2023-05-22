<?php
declare(strict_types=1);

namespace Source\Models\DTO;

use Source\App\Request;


class GettingByIdDto
{
    public int $postId;

    public function __construct(Request $req)
    {
        $this->postId = $req->getIntParam('postId');
    }
}
