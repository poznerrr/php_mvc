<?php

namespace Source\App;

use Source\Models\CategoryService;
use Source\Models\PostService;
use Source\Models\UserService;

class DependencyInjectionContainer
{
    private static array $container;

    public static function getContainer(): array
    {
        static::$container['uriMaker'] = UriMaker::getInstance();
        static::$container['postService'] = PostService::getInstance();
        static::$container['categoryService'] = CategoryService::getInstance();
        static::$container['userService'] = UserService::getInstance();
        return static::$container;
    }

}