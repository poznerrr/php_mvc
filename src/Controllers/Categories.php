<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\Registry;
use Source\Models\CategoryService;
use Source\Views\CategoryView;

class Categories extends Controller
{
    public array $categories;

    public CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = CategoryService::getInstance();
    }

    public function render(array $uriOptions = null): void
    {
        $this->categories = $this->categoryService->getAllCategories();
        $view = (new CategoryView(Registry::get('domain'), $this->categories))->buildHTML();
        $this->showOnMonitor($view);
    }

    public function delete(): void
    {
        if ($this->categoryService->deleteCategoryById((int)$_POST['id'])) {
            $this->render();
        }
    }

    public function updateCategory(): void
    {
        if ($this->categoryService->updateCategoryById((int)$_POST['id'], $_POST['name'])) {
            $this->render();
        }
    }

    public function createCategory(): void
    {
        if ($this->categoryService->createCategory($_POST['name'])) {
            $this->render();
        }
    }


}