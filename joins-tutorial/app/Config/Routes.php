<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('inner-join', "SiteController::innerJoinMethod");
$routes->get('left-join', "SiteController::leftJoinMethod");
$routes->get('right-join', "SiteController::rightJoinMethod");
