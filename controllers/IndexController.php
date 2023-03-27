<?php

namespace controllers;

use models\PostService;

class IndexController
{
    public $posts;
    public $postService;

    public function __construct()
    {
        $this->postService = PostService::getInstance();
        $this->postService->createPost("Тестовая новость 1", "Lorem ipsum", "Администратор");
        $this->postService->createPost("Тестовая новость 2", "Lorem ipsum 222", "Администратор");
    }

    public function render()
    {
        $this->posts = $this->postService->getAllPosts();
        require dirname(__DIR__) . '/views/index.phtml';
    }

    public function delete()
    {
        if (isset($_POST['delete']) && isset($_POST['id'])) {
            $this->posts = $this->postService->deletePost($_POST['id']);
        }
        $this->render();
    }
}




