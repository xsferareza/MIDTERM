<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// Auth
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::processLogin');
$routes->get('logout', 'Auth::logout');

// Products
$routes->get('products', 'Products::index');
$routes->get('products/create', 'Products::create');
$routes->post('products/store', 'Products::store');
$routes->get('products/edit/(:num)', 'Products::edit/$1');
$routes->post('products/update/(:num)', 'Products::update/$1');
$routes->get('products/delete/(:num)', 'Products::delete/$1');

// Customers
$routes->get('customers', 'Customers::index');
$routes->get('customers/create', 'Customers::create');
$routes->post('customers/store', 'Customers::store');
$routes->get('customers/edit/(:num)', 'Customers::edit/$1');
$routes->post('customers/update/(:num)', 'Customers::update/$1');
$routes->get('customers/delete/(:num)', 'Customers::delete/$1');

// Staff / Users
$routes->get('users', 'Users::index');
$routes->get('users/create', 'Users::create');
$routes->post('users/store', 'Users::store');

// Sales
$routes->get('sales/create', 'Sales::create');
$routes->post('sales/process', 'Sales::process');
$routes->get('sales/history', 'Sales::history');
