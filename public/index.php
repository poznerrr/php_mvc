<?php

declare(strict_types=1);
require_once dirname(__DIR__) . '/vendor/autoload.php';

use app\Router;

$router = new Router();
$router->route($_SERVER['REQUEST_URI']);

// echo "Вы находитесь по адресу: ".parse_ugit branchrl($url, PHP_URL_PATH);





