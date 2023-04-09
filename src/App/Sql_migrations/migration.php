<?php

declare(strict_types=1);
require_once dirname(__DIR__, 3) . '/vendor/autoload.php';

$config = require dirname(__DIR__, 3) . '/config/config.php';
$dbObject = new PDO($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['opts']);
const TABLE_MIGRATIONS = 'migrations';

$files = getMigrationFiles($dbObject);
if (empty($files)) {
    echo "База данных в актуальном состоянии";
} else {
    echo "Старт миграции...\n\n";

    foreach ($files as $file) {
        migrate($config, $dbObject, $file);
        echo basename($file) . "\n";
    }
    echo "Миграция завершена.\n";
}

function getMigrationFiles($con): array
{
    $sqlFolder = str_replace('\\', '/', realpath(dirname(__FILE__)) . '/');
    echo "$sqlFolder";
    $allFiles = glob($sqlFolder . '*sql');
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
    return array_diff($allFiles, $versionsFiles);
}

function migrate($config, $con, $file)
{
    $command = sprintf(
        "mysql -u%s -p%s -h %s %s  < %s",
        $config['db']['user'],
        $config['db']['pass'],
        $config['db']['hostName'],
        $config['db']['dbname'],
        $file
    );
    shell_exec($command);

    $baseName = basename($file);
    $query = sprintf("INSERT INTO %s (name) VALUES('%s')", TABLE_MIGRATIONS, $baseName);
    $con->query($query);
}