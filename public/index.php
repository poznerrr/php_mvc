<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use controllers\RoutingController;

$routingController = new RoutingController();
$routingController->route($_SERVER['REQUEST_URI']);

// echo "Вы находитесь по адресу: ".parse_ugit branchrl($url, PHP_URL_PATH);





