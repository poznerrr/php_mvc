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
            $this->makeController('INDEX', $controllersFolder)->render();
        } else {
            $controllerName = strtoupper($_GET['controller']);
            $controller = $this->makeController($controllerName, $controllersFolder);
            if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
                $action = $_GET['action'];
                $controller->$action();
            } else {
                $this->makeController('NOTFOUND', $controllersFolder)->render();
            }
        }
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