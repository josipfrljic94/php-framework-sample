<?php


require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;
use app\core\Request;


$req= new Request();
$app = new Application(dirname(__DIR__));
$sCon = new SiteController();
$app->router->get("/", [SiteController::class , "home"]);
$app->router->get("/contact",[SiteController::class , "contact"]);
$app->router->post("/contact", [SiteController::class , "handleContact"]);
$app->router->get("/login", [AuthController::class , "login"]);
$app->router->get("/register", [AuthController::class , "register"]);
$app->router->post("/login", [AuthController::class , "login"]);
$app->router->post("/register", [AuthController::class , "register"]);


$app->run();