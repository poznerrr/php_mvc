<?php

declare(strict_types=1);

session_start();
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Source\App\{Router, Registry};

$router = new Router();
$config = require dirname(__DIR__) . '/config/config.php';

$dbObject = new PDO($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['opts']);

Registry::set('dbObject', $dbObject);
Registry::set('domain', $config['domain']);
Registry::set('pageNewsNumber', $config['pageNewsNumber']);

$router->route();






