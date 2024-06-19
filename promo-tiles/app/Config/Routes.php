<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Promotions;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/promotions', [Promotions::class, 'index']);
$routes->get('/promotions/new', [Promotions::class, 'new']);
$routes->get('promotions/success', [Promotions::class, 'success']);
$routes->post('promotions', [Promotions::class, 'create']);
$routes->delete('/promotions/(:num)', 'Promotions::delete/$1');
$routes->get('/promotions/edit/(:num)', 'Promotions::edit/$1');
$routes->post('/promotions/update/(:num)', 'Promotions::update/$1');