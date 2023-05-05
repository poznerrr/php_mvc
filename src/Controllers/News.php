<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{Registry, Request, UriMaker};
use Source\Models\{PostService, Post};
use Source\Views\NewsView;

class News extends Controller
{
    private Post $post;
    private PostService $postService;
    public UriMaker $uriMaker;

    public function __construct()
    {
        $this->postService = PostService::getInstance();
        $this->uriMaker = UriMaker::getInstance();
    }

    public function renderDefault(Request $req): void
    {
        $postId = $req->getParam('postId');
        try {
            $this->post = $this->postService->getPostById($postId);
            $rightUri = $this->uriMaker->makeTitleUri($this->post);
            if ($rightUri === $req->getParam('REQUEST_URI')) {
                $view = (new NewsView(Registry::get('domain'), $this->post))->buildHTML();
                $this->showOnMonitor($view);
            } else {
                header("Location: $rightUri");
            }
        } catch
        (\Error) {
            header("Location: /NotFound");
        }
    }

}