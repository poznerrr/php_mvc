<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\Registry;
use Source\Models\PostService;
use Source\Views\IndexView;

class Index extends Controller
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
        $view = (new IndexView(Registry::get('domain'),$this->posts))->buildHTML();
        $this->showOnMonitor($view);
    }

}



