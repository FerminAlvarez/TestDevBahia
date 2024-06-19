<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Promos;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/promos', [Promos::class, 'index']);
