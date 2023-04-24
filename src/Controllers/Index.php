<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{Registry, Paginator};
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

    public function render(array $uriOptions = null): void
    {
        if (isset($_POST['delete']) && isset($_POST['id'])) {
            $this->postService->deletePost(($_POST['id']));
        }
        $pageNumber =(int)($uriOptions['page'] ?? 1);
        $firstNews = ($pageNumber - 1) * Registry::get('pageNewsNumber');
        $this->posts = $this->postService->getPostsBetween($firstNews, Registry::get('pageNewsNumber'));
        $paginatorPages = Paginator::getPages((int)$pageNumber);
        $view = (new IndexView(Registry::get('domain'), $this->posts, $pageNumber, $paginatorPages))->buildHTML();
        $this->showOnMonitor($view);
    }

}




