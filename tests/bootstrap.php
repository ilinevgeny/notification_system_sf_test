<?php

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Process\Process;

require dirname(__DIR__).'/vendor/autoload.php';

if (file_exists(dirname(__DIR__).'/config/bootstrap.php')) {
    require dirname(__DIR__).'/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

echo "\e[32m> Clear database.. \e[0m";

$process = new Process(['./bin/console', 'doctrine:database:drop', '--env=test', '--force']);
$process->start();

foreach ($process as $type => $data) {
    echo $data;
}

echo "\e[32m> Create database.. \e[0m";

$process = new Process(['./bin/console', 'doctrine:database:create', '--env=test']);
$process->start();

foreach ($process as $type => $data) {
    echo $data;
}

echo "\e[32m> Run migration.. \e[0m";

$process = new Process(['./bin/console', 'doctrine:migration:migrate', '--env=test']);
$process->start();

foreach ($process as $type => $data) {
    echo $data;
}