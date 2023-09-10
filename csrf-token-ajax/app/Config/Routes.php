<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get("my-form", "Site::myForm");
$routes->post('submit-data', "Site::submitData");

