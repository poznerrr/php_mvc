<?php

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
        $this->postService->createPost("Тестовая новость 1", "Lorem ipsum", "Администратор");
        $this->postService->createPost("Тестовая новость 2", "Lorem ipsum 222", "Администратор");
    }

    public function render(): void
    {
        $this->posts = $this->postService->getAllPosts();
        new IndexView($this->posts);
    }

    public function delete(): void
    {
        if (isset($_POST['delete']) && isset($_POST['id'])) {
            $this->posts = $this->postService->deletePost($_POST['id']);
        }
        $this->render();
    }
}




