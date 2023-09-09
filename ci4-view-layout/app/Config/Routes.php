<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get("first-route", function(){
    
    //method 1
    $data = ["name" => "yusuf", "email" => "yusuf@gmail.com"];
    return view("layout/master", $data);

    //method 2
    // $data["name"] = "yusuf";
    // $data["email"] = "yusuf@gmail.com";
    // return view("my-file", $data);

    // // method 3
    // $name = "yusuf";
    // $email = "yusuf@gmail.com";
    // return view("my-file", compact("name", "email"));
});
