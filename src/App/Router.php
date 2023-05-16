<?php

declare(strict_types=1);

namespace Source\App;

use Source\Controllers\Controller;
use Source\Controllers\{ControllerAPI, Index, NotFound};

class Router
{

    public static function parse(array $pathes): array
    {
        $pureUri = trim($_SERVER['REQUEST_URI'], "\t\n\r\0\x0B/");
        $uriTemplates = $pathes;
        $parametersKeys = [];
        $parametersValues = [];
        $matches = [];
        foreach ($uriTemplates as $templateKey => $templateValue) {
            if (preg_match($templateKey, $pureUri, $matches)) {
                $parametersKeys = $templateValue;
                $iterator = 1;
                foreach ($parametersKeys as $value) {
                    $parametersValues[] = $matches[$iterator++];
                }
                break;
            }
        }
        /*обработка исключения - пустого uri, ведущего на Index*/
        if (count($parametersValues) == 0) {
            $parametersKeys[] = 'controller';
            $parametersValues[0] = 'Index';
        }
        $parameters = array_combine($parametersKeys, $parametersValues);

        //для API - добавить к контроллеру suffix api
        if (isset($parameters['method']) && $parameters['method'] === 'api') {
            $parameters['controller'] .= $parameters['method'];
            $parameters['action'] = $_SERVER['REQUEST_METHOD'];
        }

        $parameters['controller'] = $parameters['controller'] ?? 'notFound';
        $parameters['action'] = $parameters['action'] ?? 'renderDefault';
        return $parameters;

    }

    public static function route(Request $req): void
    {
        $controller = self::makeController($req->params['controller']);
        $action = $req->params['action'];
        if (method_exists($controller, $action)) {
            $controller->$action($req);
        } /*иначе выводим 404*/
        else {
            self::makeController('notFound')->renderDefault($req);
        }
    }

    private static function makeController(string $controllerName): Controller|ControllerAPI
    {
        $controllersFolder = Registry::get('controllersFolder');
        $controller = $controllersFolder . $controllerName;
        /*если контроллера не существует выводим 404*/
        if (!class_exists($controller) || $controllerName == 'controller') {
            return new NotFound();
        }
        return new $controller();
    }
}