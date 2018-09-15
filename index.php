<?php
include_once "handlers/RequestHandler.php";
include_once "handlers/players/GetPlayersHandler.php";

include_once "routing/Router.php";
include_once "routing/RouteMapping.php";
include_once "routing/Route.php";
include_once "routing/HttpRequest.php";

header("Content-type: application/json");

$router = new Router;
registerRoutes($router);
$req = new HttpRequest($$_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"], $_SERVER["QUERY_STRING"], null);

$res = json_encode($router->handleReq($req));
echo $res;
// var_dump($res);
return $res;

function registerRoutes(Router $router)
{
    $router->addMapping(new RouteMapping(new Route("/test", "GET")));
    $router->addMapping(new RouteMapping(new Route("/api/players", "GET"), new GetPlayersHandler));
}