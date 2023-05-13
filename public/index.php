<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Source\App\{Router, Registry, AuthorizationChecker, Request};

$config = require dirname(__DIR__) . '/config/config.php';

$routePathes = require dirname(__DIR__) . '/config/route_pathes.php';

$dbObject = new PDO($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['opts']);

Registry::set('dbObject', $dbObject);
Registry::set('domain', $config['domain']);
Registry::set('pageNewsNumber', $config['pageNewsNumber']);
Registry::set('controllersFolder', $config['controllersFolder']);

AuthorizationChecker::checkAuthorization();
$request = new Request(Router::parse($routePathes));

Router::route($request);






