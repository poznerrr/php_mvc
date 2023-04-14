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

    public function route(): void
    {
        $controllersFolder = "Source\\Controllers\\";
        //если стартовая страница
        if (!isset($_GET['controller']) && !isset($_GET['action'])) {
            $controllerName = 'index';
            $actionName = 'render';
        } else {
            if (!isset($_GET['controller']) || !isset($_GET['action'])) {
                $controllerName = 'notfound';
                $actionName = 'render';
            } else {
                $controllerName = $_GET['controller'];
                $actionName = $_GET['action'];
            }
        }
        $controller = $this->makeController($controllerName, $controllersFolder);
        method_exists($controller, $actionName) ? $controller->$actionName() :
            $this->makeController('notfound', $controllersFolder)->render();
    }

    private function makeController(
        string $controllerName,
        string $controllersFolder
    ): Controller {
        $controller = $controllersFolder . $controllerName;
        if ($controller == $controllersFolder) {
            return new Index();
        } elseif (!class_exists($controller) || $controllerName == 'controller') {
            return new NotFound();
        }
        return new $controller();
    }
}