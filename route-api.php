<?php
    require_once('libs/Router.php');
    require_once('./api/controllers/room.api.controller.php');
    require_once './api/controllers/auth.api.controller.php';
    
    // CONSTANTES PARA RUTEO
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

    $router = new Router();

    // rutas
    $router->addRoute("/rooms", "GET", "RoomApiController", "getRooms");
    $router->addRoute("/rooms/:ID", "GET", "RoomApiController", "getRoom");
    $router->addRoute("/rooms/:ID", "DELETE", "RoomApiController", "deleteRoom");
    $router->addRoute("/rooms", "POST", "RoomApiController", "addRoom");
    $router->addRoute("/rooms/:ID", "PUT", "RoomApiController", "updateRoom");

    $router->addRoute("/auth/token", 'GET', 'AuthApiController', 'getToken');

    //run
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);

