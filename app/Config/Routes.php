<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\Crud;
use App\Controllers\Upload;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', [Crud::class, 'index']);
$routes->get('create', [Crud::class, 'index']);
$routes->post('create', [Crud::class, 'create']);

$routes->get('edit/foto/(:any)', [Upload::class, 'fotoUpdateGet']);
$routes->post('edit/foto/(:any)', [Upload::class, 'fotoUpdatePost']);

$routes->get('edit/1/(:any)', [Crud::class, 'update']);
$routes->get('hapus/1/(:any)', [Crud::class, 'hapus']);

$routes->get('edit/(:any)', [Crud::class, 'index']);
$routes->post('edit/(:any)', [Crud::class, 'formUpdate']);



// $routes->get('upload/(:any)', [Upload::class, 'index']);
$routes->post('upload/(:any)', [Upload::class, 'upload']);
