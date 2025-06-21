<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth routes
$routes->match(['get', 'post'], 'auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');

// Public article view
$routes->get('article/(:any)', 'Home::article/$1');

// Feedback routes
$routes->match(['get', 'post'], 'feedback', 'Home::feedback');

// Admin routes
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Article routes
    $routes->get('article', 'Admin\Article::index');
    $routes->match(['get', 'post'], 'article/create', 'Admin\Article::create');
    $routes->match(['get', 'post'], 'article/edit/(:num)', 'Admin\Article::edit/$1');
    $routes->get('article/delete/(:num)', 'Admin\Article::delete/$1');
    
    // Feedback routes
    $routes->get('feedback', 'Admin\Feedback::index');
    $routes->get('feedback/delete/(:num)', 'Admin\Feedback::delete/$1');
});
