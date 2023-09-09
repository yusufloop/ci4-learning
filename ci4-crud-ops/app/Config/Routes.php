<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->match(["get", "post"], "add-member", "Member::addMember");
$routes->match(["get", "post"], "edit-member/(:num)", "Member::editMember/$1");
$routes->get("list-members", "Member::listMember");
$routes->get("delete-member/(:num)", "Member::deleteMember/$1");

