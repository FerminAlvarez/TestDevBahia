<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Promotions;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/promotions', [Promotions::class, 'index']);
