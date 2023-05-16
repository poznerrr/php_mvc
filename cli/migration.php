<?php

declare(strict_types=1);
require_once dirname(__DIR__) . '/vendor/autoload.php';

if (PHP_SAPI === 'cli') {
    echo "Скрипт запущен...\n";
} else {
    die("Запустите скрипт из консоли");
}

$config = require dirname(__DIR__) . '/config/config.php';
$dbObject = new PDO($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['opts']);
const TABLE_MIGRATIONS = 'migrations';

$files = getMigrationFiles($dbObject);
if (empty($files)) {
    echo "База данных в актуальном состоянии";
} else {
    echo "Старт миграции...\n\n";

    foreach ($files as $file) {
        migrate($dbObject, $file);
        echo basename($file) . "\n";
    }
    echo "Миграция завершена.\n";
}

function getMigrationFiles(PDO $con): array
{
    $sqlFolder = __DIR__ . DIRECTORY_SEPARATOR . 'sql_migrations' . DIRECTORY_SEPARATOR;
    echo "Директория с sql: $sqlFolder \n";

    //Способ перебора с readdir
    /*$handleDir = opendir($sqlFolder);
        while (false !== ($file = readdir($handleDir)))
        {
            if ($file != "." && $file != "..")
            $allFiles[] = $sqlFolder.$file;
        }
    */

    //Способ перебора с RecursiveDirectoryIterator
    /*$iterator = new RecursiveDirectoryIterator($sqlFolder);
    $iterator = new RecursiveIteratorIterator($iterator);
    $allFiles = [];
    foreach ($iterator as $file) {
        if ($file->getFilename() != "." && $file->getFilename() != "..") {
            $allFiles[] = $sqlFolder . $file->getFilename();
        }
    }
    */

    //Способ с FileSystemIterator
    $iterator = new FilesystemIterator($sqlFolder, FilesystemIterator::SKIP_DOTS);
    $allFiles = [];
    foreach ($iterator as $file) {
        $allFiles[] = $sqlFolder . $file->getFilename();
    }


    $query = sprintf("SHOW TABLES LIKE '%s'", TABLE_MIGRATIONS);
    $data = $con->query($query);
    if (!$data->rowCount()) {
        return $allFiles;
    }

    $versionsFiles = [];
    $query = sprintf("SELECT name FROM `%s`", TABLE_MIGRATIONS);
    $data = $con->query($query)->fetchAll();
    foreach ($data as $row) {
        $versionsFiles[] = $sqlFolder . $row['name'];
    }
    $migrationFiles = array_diff($allFiles, $versionsFiles);
    natsort($migrationFiles);
    return  $migrationFiles;
}

function migrate($con, $file): void
{
    $query = file_get_contents($file);
    $con->exec($query);
    $baseName = basename($file);
    $query = sprintf("INSERT INTO %s (name) VALUES('%s')", TABLE_MIGRATIONS, $baseName);
    $con->query($query);
}