<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('customers', 'CustomerAccounts::index');
$routes->get('users', 'UserAccounts::index');

$routes->get('customers/new', 'CustomerAccounts::new');
$routes->post('customers', 'CustomerAccounts::create');
$routes->get('customers/(:num)/edit', 'CustomerAccounts::edit/$1');
$routes->post('customers/(:num)/edit', 'CustomerAccounts::update/$1');

$routes->get('users/new', 'UserAccounts::new');
$routes->post('users', 'UserAccounts::create');
$routes->get('users/(:num)/edit', 'UserAccounts::edit/$1');
$routes->post('users/(:num)/edit', 'UserAccounts::update/$1');