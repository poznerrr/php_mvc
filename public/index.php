<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use controllers\IndexController;
use controllers\NotFoundController;

$url = $_SERVER['REQUEST_URI'];
// echo "Вы находитесь по адресу: ".parse_ugit branchrl($url, PHP_URL_PATH);

$indexController = new IndexController();
$notFoundController = new NotFoundController();

switch ($url)
{
    case '/':
        if (isset($_POST['delete']) && isset($_POST['id']))
        {
            $indexController->delete();
        }
        else
            $indexController->render();
        break;
    default:
        $notFoundController->render();
        break;
}


