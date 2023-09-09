<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('add-user', 'UserController::addUser');
$routes->post("save-user", "UserController::saveUser");
