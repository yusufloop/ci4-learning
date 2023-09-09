<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get("list-blog", "DataController::listBlogs");
$routes->get("single-blog/(:num)", "DataController::singleBlog/$1");
