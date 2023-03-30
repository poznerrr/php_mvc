<?php

declare(strict_types=1);

namespace controllers;

use models\PostService;
use views\IndexView;

class IndexController
{
    public array $posts;
    public PostService $postService;

    public function __construct()
    {
        $this->postService = PostService::getInstance();
    }

    public function render(): void
    {
        $this->posts = $this->postService->getAllPosts();
        (new IndexView($this->posts))->build();
    }

    public function delete(): void
    {
        if (isset($_POST['delete']) && isset($_POST['id'])) {
            $this->posts = $this->postService->deletePost((int)($_POST['id']));
        }
        $this->render();
    }
}




