<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{Registry, Paginator, Request, UriMaker};
use Source\Models\PostService;
use Source\Views\IndexView;

class Index extends ControllerHTTP
{
    public array $posts;

    public function __construct()
    {
    }

    public function get(Request $req, PostService $postService, UriMaker $uriMaker): void
    {
        $pageNumber = $req->getIntParam('page') ?? 1;
        $firstNews = ($pageNumber - 1) * Registry::get('pageNewsNumber');
        $this->posts = $postService->getPostsBetween($firstNews, Registry::get('pageNewsNumber'));
        $paginatorPages = Paginator::getPages($pageNumber);
        $newsCount = $postService->getPostsCount();
        $view = (new IndexView(Registry::get('domain'), $this->posts, $pageNumber, $paginatorPages, $uriMaker, $newsCount))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function findSearch(Request $req, PostService $postService, UriMaker $uriMaker): void
    {
        $searchCombination = $req->getParam('searchCombination');
        $pageNumber = $req->getIntParam('page') ?? 1;
        $firstNews = ($pageNumber - 1) * Registry::get('pageNewsNumber');
        $this->posts = $postService->getFindPostsBetween($firstNews, Registry::get('pageNewsNumber'), $searchCombination);
        $paginatorPages = Paginator::getPages($pageNumber, $searchCombination);
        $newsCount = $postService->getPostsCountWithSearch($searchCombination);
        $view = (new IndexView(Registry::get('domain'), $this->posts, $pageNumber, $paginatorPages, $uriMaker, $newsCount, $searchCombination))->buildHTML();
        $this->showOnMonitor($view);
    }

}




