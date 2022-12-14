<?php

//FROM INSTALLED PACKAGE  vlucas/phpdotenv
use Dotenv\Dotenv;

require_once __DIR__ . "/../vendor/autoload.php";

//FOR ENV TESTING 
$dotenv=Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;
use app\core\Request;

$config=[
    "db" =>[
        "dsn" =>$_ENV["DB_DSN"],
        "user"=>$_ENV["DB_USER"],
        "password"=>$_ENV["DB_PASSWORD"]
    ]
    ];


$req= new Request();
$app = new Application(dirname(__DIR__),$config);
$sCon = new SiteController();
$app->router->get("/", [SiteController::class , "home"]);
$app->router->get("/contact",[SiteController::class , "contact"]);
$app->router->post("/contact", [SiteController::class , "handleContact"]);
$app->router->get("/login", [AuthController::class , "login"]);
$app->router->get("/register", [AuthController::class , "register"]);
$app->router->post("/login", [AuthController::class , "login"]);
$app->router->post("/register", [AuthController::class , "register"]);


$app->run();