<?php

declare(strict_types=1);

namespace Source\App;

use Source\Controllers\ControllerHTTP;
use Source\Controllers\{ControllerAPI, NotFound};

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
            $parameters['action'] = $parameters['action'] ?? $_SERVER['REQUEST_METHOD'];
        }

        $parameters['controller'] = $parameters['controller'] ?? 'notFound';
        $parameters['action'] = $parameters['action'] ?? 'get';
        return $parameters;

    }

    public static function route(Request $req, DependencyInjectionContainer $depInjContainer): void
    {
        $controller = self::makeController($req->params['controller']);
        $action = $req->params['action'];
        if (method_exists($controller, $action)) {
            $reflection = new \ReflectionMethod($controller, $action);
            //Первым всегда будет request, сервисы идут с позиции 1
            $serviceNames = array_slice($reflection->getParameters(), 1);
            $services = [];
            foreach ($serviceNames as $service) {
                $services[] = $depInjContainer->make($service->getName());
            }
            $controller->$action($req, ...$services);
        } /*иначе выводим 404*/
        else {
            self::makeController('notFound')->get($req);
        }
    }

    private static function makeController(string $controllerName): ControllerHTTP|ControllerAPI
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