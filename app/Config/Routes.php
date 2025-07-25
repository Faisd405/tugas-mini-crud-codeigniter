<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Library::index');

$routes->get('/profile-picture/(:any)', 'Profile::profilePicture/$1');

// Auth routes
$routes->match(['get', 'post'], 'auth/login', 'Auth::login');
$routes->match(['get', 'post'], 'auth/register', 'Register::index');
$routes->get('auth/logout', 'Auth::logout');

// Library routes (public)
$routes->get('library', 'Library::index');
$routes->get('library/book/(:num)', 'Library::book/$1');
$routes->get('library/search', 'Library::search');

// Public article view (keep for backward compatibility)
$routes->get('article/(:any)', 'Home::article/$1');

// Feedback routes
$routes->match(['get', 'post'], 'feedback', 'Home::feedback');

// Admin routes
$routes->group('admin', function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // Book routes
    $routes->get('book', 'Admin\Book::index');
    $routes->match(['get', 'post'], 'book/create', 'Admin\Book::create');
    $routes->match(['get', 'post'], 'book/edit/(:num)', 'Admin\Book::edit/$1');
    $routes->get('book/delete/(:num)', 'Admin\Book::delete/$1');
    $routes->get('book/view/(:num)', 'Admin\Book::view/$1');

    // Article routes (keep for backward compatibility)
    $routes->get('article', 'Admin\Article::index');
    $routes->match(['get', 'post'], 'article/create', 'Admin\Article::create');
    $routes->match(['get', 'post'], 'article/edit/(:num)', 'Admin\Article::edit/$1');
    $routes->get('article/delete/(:num)', 'Admin\Article::delete/$1');

    // Feedback routes
    $routes->get('feedback', 'Admin\Feedback::index');
    $routes->get('feedback/delete/(:num)', 'Admin\Feedback::delete/$1');
});

// Profile routes
$routes->get('profile', 'Profile::index');
$routes->match(['get', 'post'], 'profile/edit', 'Profile::edit');
$routes->post('profile/uploadPicture', 'Profile::uploadPicture');
$routes->get('profile/deletePicture', 'Profile::deletePicture');

// Test routes
$routes->get('test', 'Test::index');
$routes->post('test/post', 'Test::post');
