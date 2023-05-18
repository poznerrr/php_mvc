<?php
declare(strict_types=1);

namespace Source\Models\DTO;

use Source\App\Request;

class PostCreatorDto
{
    public string $authorizeString;
    public string $title;
    public string $post;
    public int $categoryId;
    public bool $isValid = false;

    public function __construct(Request $req)
    {
        if ($req->getParam('HTTP_AUTHORIZATION')
            && $req->getParam('title')
            && $req->getParam('post')
            && $req->getIntParam('categoryId')
        ) {
            $this->isValid = true;
            $this->title = $req->getParam('title');
            $this->post = $req->getParam('post');
            $this->categoryId = $req->getIntParam('categoryId');
            $this->authorizeString = $req->getParam('HTTP_AUTHORIZATION');
        }
    }
}