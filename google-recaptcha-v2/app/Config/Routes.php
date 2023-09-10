<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('form', 'RegisterController::index');
$routes->post('form-submit', 'RegisterController::googleCaptchaStore');
