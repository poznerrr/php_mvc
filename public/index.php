<?php

declare(strict_types=1);

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Source\App\{Router, Registry, AuthorizationChecker, Request, DependencyInjectionContainer};

$config = require dirname(__DIR__) . '/config/config.php';

$routePathes = require dirname(__DIR__) . '/config/route_pathes.php';

$dbObject = new PDO($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['opts']);


Registry::set('dbObject', $dbObject);
Registry::set('domain', $config['domain']);
Registry::set('pageNewsNumber', $config['pageNewsNumber']);
Registry::set('controllersFolder', $config['controllersFolder']);
Registry::set('secretKey', $config['secretKey']);
Registry::set('jwtAlg', $config['jwtAlg']);


AuthorizationChecker::checkAuthorization();
$request = new Request(Router::parse($routePathes));
$dependencyInjectionContainer = new DependencyInjectionContainer();
Router::route($request, $dependencyInjectionContainer);






