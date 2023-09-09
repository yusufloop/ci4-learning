<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get("insert-student", "StudentController::insertData");
$routes->get("update-student", "StudentController::updateData");
$routes->get("delete-student", "StudentController::deleteData");
$routes->get("get-student", "StudentController::selectData");