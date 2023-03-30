<?php

declare(strict_types=1);

namespace controllers;

use models\PostService;
use views\PostView;

class PostController
{
    public function __construct()
    {
    }

    public function render(): void
    {
        $status = null;
        if (isset($_POST['title']) && isset($_POST['text']) && isset($_POST['author'])) {
            $postService = PostService::getInstance();
            $postService->createPost($_POST['title'], $_POST['text'], $_POST['author']);
            $status = 'success';
        } else {
            $status = 'new';
        }
        (new PostView($status))->build();

    }
}