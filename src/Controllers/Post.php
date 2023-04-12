<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\Models\{CategoryService, PostService, UserService};
use Source\App\Registry;
use Source\Views\PostView;

class Post extends Controller
{

    public function __construct()
    {
    }

    public function render(): void
    {
        $categories = null;
        $users = null;
        if (isset($_POST['title']) && isset($_POST['text']) && isset($_POST['author']) && isset($_POST['category'])) {
            $postService = PostService::getInstance();
            $postService->createPost($_POST['title'], $_POST['text'], (int)$_POST['author'], (int)$_POST['category']);
            $status = 'success';
        } else {
            $categoryService = CategoryService::getInstance();
            $categories = $categoryService->getAllCategories();
            $userService = UserService::getInstance();
            $users = $userService->getAllUsers();

            $status = 'new';
        }
        $view = (new PostView(Registry::get('domain'), $status, $categories, $users))->buildHTML();
        $this->showOnMonitor($view);
    }
}