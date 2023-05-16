<?php
declare(strict_types=1);

$db = ['host' => 'mysql:host=mariadb:3306; dbname=mvc;charset=utf8mb4',
    'user' => 'root',
    'pass' => 'root',
    'opts' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];
$domain = 'http://127.0.0.1';

$pageNewsNumber = 10;

$controllersFolder = "Source\\Controllers\\";

$DtoFolder = "Source\\Models\\DTO";

return ['db' => $db,
    'domain' => $domain,
    'pageNewsNumber' => $pageNewsNumber,
    'controllersFolder' => $controllersFolder,
    'DtoFolder' => $DtoFolder];