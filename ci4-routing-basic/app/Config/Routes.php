<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// using add() method 
$routes->add("about-us", "Site::aboutUs");
$routes->add("products", "Site::ourProducts");
$routes->add("services/(:num)", "Site::services/$1");

//using get method
$routes->get("about-us", "Site::aboutUs");
$routes->get("products", "Site::ourProducts");
$routes->get("services/(:num", "Sites::services/$1");

$routes->get("contact-us", function(){
    echo "Welcome to my ci4 webpage";
});

// route with view file
$routes->get("about-us", function() {
    return view("about-us"); // /app/Views/about-us.php
});

//route with parameter
$routes->get("services/(:num)", function($id){
    echo "ID: ". $id;
});

//to pass integer value to route
$routes->get("services/(:num)", "Site::services/$1");
// Example : services/1, services/203, services/522

// to pass any characters
$routes->get("services/(:any)", "Site::services/$1");
// Example : services/1, services/4.55, services/sample-service

// to pass alphabetics
$routes->get("services/(:alpha)","Site::services/$1");
// Example : services/sample-service

//to pass alphabets and number in URL
$routes->get("services/(:alphanum)", "Site::services/$1");
// Example : services/service-cod-1002


//To pass multiple values in Routes,
//to pass number, alphabets
$outes->get("services/(:num)/(:alpha)", "Site::services/$1/$2");
// Example : services/101/sample-service

//Create routes
$routes->add('our-services', 'Site::services', ['as' => 'services']);

//or

$routes->get('our-services', 'Site::services', ['as' => 'services']);

//use it in view


//handle redirect routes
$routes->addRedirect("about-us", "contact-us");

//routes get /post
$routes->get('services', 'Site::services');
$routes->post('services', 'Site::services');

// OR When we have the same route with different different request types
$routes->match(['get', 'post'], 'services', 'Site::services');

//put method
$routes->put('services/(:num)', 'Site::services/$1');

//delete method
$routes->delete('services/(:num)', 'Site::services/$1');

//cli routes
$routes->match(["get", "post"], 'services', 'Site::services');
$routes->put('services/(:num)', 'Site::services/$1');
$routes->delete('services/(:num)', 'Site::services/$1');
