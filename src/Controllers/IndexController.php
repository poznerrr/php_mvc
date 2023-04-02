<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\Models\PostService;
use Source\Views\IndexView;

class IndexController extends Controller
{
    public array $posts;
    public PostService $postService;

    public function __construct()
    {
        $this->postService = PostService::getInstance();
    }

    public function render(): void
    {
        if (isset($_POST['delete']) && isset($_POST['id'])) {
            $this->posts = $this->postService->deletePost((int)($_POST['id']));
        } else
            $this->posts = $this->postService->getAllPosts();
        (new IndexView($this->posts))->build();
    }

}




