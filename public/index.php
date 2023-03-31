<?php

declare(strict_types=1);
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/config/db.php';

use app\{Router, Registry};

$router = new Router();
$dbObject = new PDO($attr, $user, $pass, $opts);
Registry::set('dbObject', $dbObject);
$router->route($_SERVER['REQUEST_URI']);

// echo "Вы находитесь по адресу: ".parse_ugit branchrl($url, PHP_URL_PATH);





