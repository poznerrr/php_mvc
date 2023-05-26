<?php

namespace Source\App;

use Source\Interfaces\IInstanceble;
use Source\Models\CategoryService;
use Source\Models\PostService;
use Source\Models\UserService;

class DependencyInjectionContainer
{
    private array $container = [
        'uriMaker' => UriMaker::class,
        'postService' => PostService::class,
        'categoryService' => CategoryService::class,
        'userService' => UserService::class
    ];

    public function make(string $className): IInstanceble
    {
        try {
            return $this->container[$className]::getInstance();
        } catch (\Throwable $e) {
            echo($e->getMessage());
        }
    }

}