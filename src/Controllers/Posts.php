<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{Paginator, Registry};
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

    public function render(array $uriOptions = null): void
    {
        if (isset($_POST['delete']) && isset($_POST['id'])) {
            $this->postService->deletePost(($_POST['id']));
        }
        $pageNumber = (int)($uriOptions['page'] ?? 1);
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

    public function deletePost(): void
    {
        $this->postService->deletePost(($_POST['id']));
        $this->render();
    }

    public function updatePost(): void
    {
        if ($this->postService->updatePost(($_POST['title']), $_POST['text'], $_POST['author'], $_POST['category'], $_POST['id'])) {
            $this->render();
        }
    }

}