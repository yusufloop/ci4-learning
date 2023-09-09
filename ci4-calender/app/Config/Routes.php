<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('fullcalendar', 'FullcalendarController::index');
$routes->get("event", "FullcalendarController::loadData");
$routes->post("eventAjax", "FullcalendarController::ajax");
