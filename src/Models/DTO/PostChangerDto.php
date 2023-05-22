<?php
declare(strict_types=1);

namespace Source\Models\DTO;

use Source\App\Request;

class PostChangerDto
{
    public string $title;
    public string $post;
    public int $postId;
    public int $categoryId;


    public function __construct(Request $req)
    {
        $this->title = $req->getParam('title');
        $this->post = $req->getParam('post');
        $this->categoryId = $req->getIntParam('categoryId');
        $this->postId = $req->getIntParam('postId');
    }
}
