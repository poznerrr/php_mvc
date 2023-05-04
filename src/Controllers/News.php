<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{Registry, Request};
use Source\Models\{PostService, Post};
use Source\Views\NewsView;

class News extends Controller
{
    private Post $post;
    private PostService $postService;

    public function __construct()
    {
        $this->postService = PostService::getInstance();
    }

    public function renderDefault(Request $req): void
    {
        $postId = $req->getParam('postId');
        try {
            $this->post = $this->postService->getPostById($postId);
            $view = (new NewsView(Registry::get('domain'), $this->post))->buildHTML();
            $this->showOnMonitor($view);
        }
        catch (\Error $e) {
            header("Location: /NotFound");
        }
    }
}