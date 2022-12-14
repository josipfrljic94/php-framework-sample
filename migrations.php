<?php

//FROM INSTALLED PACKAGE  vlucas/phpdotenv
use Dotenv\Dotenv;
use app\core\Application;

require_once __DIR__."/vendor/autoload.php";

//FOR ENV TESTING 
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    "db" => [
        "dsn" => $_ENV["DB_DSN"],
        "user" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASSWORD"]
    ]
];

$app = new Application(__DIR__, $config);
$app->db->applyMigrations();