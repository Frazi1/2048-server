<?php
include_once "handlers/RequestHandler.php";
include_once "handlers/players/GetPlayersHandler.php";

include_once "routing/Router.php";
include_once "routing/RouteMapping.php";
include_once "routing/Route.php";
include_once "routing/HttpRequest.php";

$router = new Router;
registerRoutes($router);

$route = new Route($_SERVER["PATH_INFO"], $_SERVER["REQUEST_METHOD"]);
$req = new HttpRequest($route);

$res = json_encode($router->handleReq($req));
var_dump($res);
return $res;

function registerRoutes(Router $router)
{
    $router->addMapping(new RouteMapping(new Route("/test", "GET")));
    $router->addMapping(new RouteMapping(new Route("/api/players", "GET"), new GetPlayersHandler));
}