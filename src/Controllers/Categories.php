<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{Registry, Request};
use Source\Models\CategoryService;
use Source\Views\CategoryView;

class Categories extends ControllerHTTP
{
    public array $categories;


    public function __construct()
    {
    }

    public function get(Request $req, CategoryService $categoryService): void
    {
        $this->categories = $categoryService->getAllCategories();
        $view = (new CategoryView(Registry::get('domain'), $this->categories))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function delete(Request $req, CategoryService $categoryService): void
    {
        if ($categoryService->deleteCategoryById($req->getIntParam('id'))) {
            header("Location: /categories");
        }
    }

    public function updateCategory(Request $req, CategoryService $categoryService): void
    {
        if ($categoryService->updateCategoryById($req->getIntParam('id'), $req->getParam('name'))) {
            header("Location: /categories");
        }
    }

    public function createCategory(Request $req, CategoryService $categoryService): void
    {
        if ($categoryService->createCategory($req->getParam('name'))) {
            header("Location: /categories");
        }
    }

}