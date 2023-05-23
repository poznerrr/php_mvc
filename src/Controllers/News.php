<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{Paginator, Registry, Request, UriMaker};
use Source\Models\{CategoryService, Post, PostService, UserService};
use Source\Views\NewsView;
use Source\Views\PostsView;
use Source\Views\PostView;

class News extends ControllerHTTP
{
    public array $posts;


    public function __construct()
    {
    }

    public function get(Request $req, PostService $postService, CategoryService $categoryService, UserService $userService): void
    {

        $pageNumber = $req->getIntParam('page') ?? 1;
        $firstNews = ($pageNumber - 1) * Registry::get('pageNewsNumber');
        $this->posts = $postService->getPostsBetween($firstNews, Registry::get('pageNewsNumber'));
        $paginatorPages = Paginator::getPages($pageNumber);
        $categories = $categoryService->getAllCategories();
        $users = $userService->getAllUsers();
        $view = (new PostsView(Registry::get('domain'), $this->posts, $pageNumber, $paginatorPages, $categories, $users))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function add(Request $req, CategoryService $categoryService, UserService $userService): void
    {
        $status = 'new';
        $categories = $categoryService->getAllCategories();
        $users = $userService->getAllUsers();
        $view = (new PostView(Registry::get('domain'), $status, $categories, $users))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function create(Request $req, PostService $postService): void
    {
        $categories = null;
        $users = null;
        $status = null;
        if (($req->getParam('title') !== null)
            && ($req->getParam('text') !== null)
            && ($req->getIntParam('author') !== null)
            && ($req->getIntParam('category') !== null)
        ) {
            $postService->createPost(
                $req->getParam('title'),
                $req->getParam('text'),
                $req->getIntParam('author'),
                $req->getIntParam('category'));
            $status = 'success';
        }
        $view = (new PostView(Registry::get('domain'), $status, $categories, $users))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function deletePost(Request $req, PostService $postService): void
    {
        $postId = $req->getIntParam('id');
        $postService->deletePost($postId);
        header("Location: /news");
    }

    public function updatePost(Request $req, PostService $postService): void
    {
        if ($postService->updatePost(
            $req->getParam('title'),
            $req->getParam('text'),
            $req->getIntParam('author'),
            $req->getIntParam('category'),
            $req->getIntParam('id'))) {
            header("Location: /news");
        }
    }

    public function chosen(Request $req, PostService $postService, UriMaker $uriMaker): void
    {
        $postId = $req->getIntParam('postId');
        try {
            $post = $postService->getPostById($postId);
            $rightUri = $uriMaker->makeTitleUri($post);
            if ($rightUri === $req->getParam('REQUEST_URI')) {
                $similarNews = $postService->getTopSimilarPosts($post->getId(), $post->getTitle());
                $view = (new NewsView(Registry::get('domain'), $post, $similarNews, $uriMaker))->buildHTML();
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