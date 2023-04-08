<?php

declare(strict_types=1);
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Source\App\{Router, Registry};

$router = new Router();
$config = require_once dirname(__DIR__) . '/config/config.php';

$dbObject = new PDO($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['opts']);

Registry::set('dbObject', $dbObject);
Registry::set('domain', $config['domain']);

$router->route($_SERVER['REQUEST_URI']);






