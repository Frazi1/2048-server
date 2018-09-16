<?php
$vendorPath = "vendor";

include_once "controllers/PlayerController.php";
require "services/PlayerService.php";
require "$vendorPath/altorouter/altorouter/AltoRouter.php";
require "persistence/models/Player.php";
require "persistence/Database.php";
require "persistence/DataMapper.php";
require "persistence/PlayerMapper.php";


header("Content-type: application/json");

$playerCtrl = new PlayerController(new PlayerService);
$database = new Database;
DataMapper::init($database->getConnection());


$router = new AltoRouter;
$router->map('GET','/api/players', [$playerCtrl, 'getAll'] );
$router->map('POST','/api/players', [$playerCtrl, 'add']);
$router->map('GET','/api/players/[i:id]', [$playerCtrl, 'getById']);
$match = $router->match($_SERVER["REQUEST_URI"]);

if( $match && is_callable( $match['target'] ) ) {
	// echo 'matched';
	echo json_encode(call_user_func_array( $match['target'], $match['params'] )); 
} else {
	// no route was matched
	// echo 'NOT matched';
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}