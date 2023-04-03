<?php

declare(strict_types=1);
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Source\App\{Router, Registry};

$router = new Router();
$dbConfig = require_once dirname(__DIR__) . '/config/db.php';
$dbObject = new PDO($dbConfig['attr'], $dbConfig['user'], $dbConfig['pass'], $dbConfig['opts']);

Registry::set('dbObject', $dbObject);
$router->route($_SERVER['REQUEST_URI']);

// echo "Вы находитесь по адресу: ".parse_ugit branchrl($url, PHP_URL_PATH);





