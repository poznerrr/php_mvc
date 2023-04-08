<?php

declare(strict_types=1);

namespace Source\App;

use Source\Controllers\Controller;

class Router
{

    public function __construct()
    {
    }

    public function route(string $url): void
    {
        $this->getController($url)->render();
    }

    private function getController(string $url): Controller
    {
        return match ($url) {
            '/' => IndexControllerFactory::createController(),
            '/post' => PostControllerFactory::createController(),
            default => NotFoundControllerFactory::createController(),
        };
    }


}