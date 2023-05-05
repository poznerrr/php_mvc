<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{Registry, Paginator, Request, UriMaker};
use Source\Models\PostService;
use Source\Views\IndexView;

class Index extends Controller
{
    public array $posts;
    public PostService $postService;
    public UriMaker $uriMaker;

    public function __construct()
    {
        $this->postService = PostService::getInstance();
        $this->uriMaker = UriMaker::getInstance();
    }

    public function renderDefault(Request $req): void
    {
        $pageNumber = $req->getIntParam('page') ?? 1;
        $firstNews = ($pageNumber - 1) * Registry::get('pageNewsNumber');
        $this->posts = $this->postService->getPostsBetween($firstNews, Registry::get('pageNewsNumber'));
        $paginatorPages = Paginator::getPages($pageNumber);
        $view = (new IndexView(Registry::get('domain'), $this->posts, $pageNumber, $paginatorPages, $this->uriMaker))->buildHTML();
        $this->showOnMonitor($view);
    }

}




