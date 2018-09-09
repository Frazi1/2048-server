<?php
include_once "routing/router.php";
include_once "routing/route.php";

$router = new Router;
$testRoute = new Route("/test", "GET");
$router->addRoute($testRoute);

$router->handleReq($_SERVER["PATH_INFO"], $_SERVER["REQUEST_METHOD"]);