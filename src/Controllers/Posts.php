<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{Paginator, Registry, Request};
use Source\Models\{CategoryService, PostService, UserService};
use Source\Views\PostsView;

class Posts extends Controller
{
    public array $posts;

    public PostService $postService;

    public function __construct()
    {
        $this->postService = PostService::getInstance();
    }

    public function renderDefault(Request $req): void
    {

        $pageNumber = $req->getIntParam('page') ?? 1;
        $firstNews = ($pageNumber - 1) * Registry::get('pageNewsNumber');
        $this->posts = $this->postService->getPostsBetween($firstNews, Registry::get('pageNewsNumber'));
        $paginatorPages = Paginator::getPages($pageNumber);
        $categoryService = CategoryService::getInstance();
        $categories = $categoryService->getAllCategories();
        $userService = UserService::getInstance();
        $users = $userService->getAllUsers();
        $view = (new PostsView(Registry::get('domain'), $this->posts, $pageNumber, $paginatorPages, $categories, $users))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function deletePost(Request $req): void
    {
        $postId = $req->getIntParam('id');
        $this->postService->deletePost($postId);
        header("Location: /posts");
    }

    public function updatePost(Request $req): void
    {
        if ($this->postService->updatePost(
            $req->getParam('title'),
            $req->getParam('text'),
            $req->getIntParam('author'),
            $req->getIntParam('category'),
            $req->getIntParam('id'))) {
            header("Location: /posts");
        }
    }

}