<?php
    require_once './libs/router.php';
    require_once './MVC/Controllers/ApiControllerPlanes.php';

    $router = new Router();

    //                endpoint               verbo   controller                  metodo

    $router->addRoute('planes',         'GET',   'PlanesApiController',     'get'); //b
    $router->addRoute('planes/:ID',     'GET',   'PlanesApiController',     'get'); //b
    $router->addRoute('planes/:ID',     'DELETE','PlanesApiController',     'deletePlan'); //b
    $router->addRoute('planes',         'POST',  'PlanesApiController',     'addPlan'); //b
    $router->addRoute('planes/:ID',     'PUT',   'PlanesApiController',     'editPlan'); //b
    $router->addRoute('planesFiltro',   'GET',   'PlanesApiController',     'FiltrarPlanes');//b ?

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);