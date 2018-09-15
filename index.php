<?php
$vendorPath = "vendor";

include_once "controllers/PlayerController.php";
require "$vendorPath/altorouter/altorouter/AltoRouter.php";

header("Content-type: application/json");
$playerCtrl = new PlayerController;

$router = new AltoRouter;
$router->map('GET','/api/players', [$playerCtrl, 'getAll'] );
$router->map('GET','/api/players/[i:id]', [$playerCtrl, 'getById']);
$match = $router->match($_SERVER["REQUEST_URI"]);

if( $match && is_callable( $match['target'] ) ) {
	echo json_encode(call_user_func_array( $match['target'], $match['params'] )); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}