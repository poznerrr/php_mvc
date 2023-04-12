<?php

declare(strict_types=1);

namespace Source\App;

use Source\Controllers\Controller;
use Source\Controllers\{Index, NotFound};

class Router
{

    public function __construct()
    {
    }

    public function route(string $url): void
    {
        $controllersFolder = "Source\\Controllers\\";
        $controllerName = strtoupper(trim($url, '/'));
        $this->makeController($controllerName, $controllersFolder)->render();
    }

    private function makeController(string $controllerName, string $controllersFolder): Controller
    {
        $controller = $controllersFolder . $controllerName;
        if ($controller == $controllersFolder) {
            return new Index();
        } elseif (!class_exists($controller) || $controllerName == 'CONTROLLER') {
            return new NotFound();
        }
        return new $controller();
    }


}