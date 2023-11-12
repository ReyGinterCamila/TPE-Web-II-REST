<?php
require_once 'libs/router.php';
require_once 'config.php';
require_once 'app/Controllers/api.categories.controller.php';
require_once 'app/Controllers/api.products.controller.php';
require_once 'app/Controllers/api.login.controller.php';
require_once 'app/Controllers/api.controller.php';

$router = new Router();

#generos
$router->addRoute('categories',     'GET',    'CategoriesController', 'get');
$router->addRoute('categories',     'POST',   'CategoriesController', 'create');
$router->addRoute('categories/:ID', 'GET',    'CategoriesController', 'get');
$router->addRoute('categories/:ID', 'PUT',    'CategoriesController', 'update');

#canciones
$router->addRoute('product',     'GET',    'ProductsController', 'get');
$router->addRoute('product',     'POST',   'ProductsController', 'create');
$router->addRoute('product/:ID', 'GET',    'ProductsController', 'get');
$router->addRoute('product/:ID', 'PUT',    'ProductsController', 'update');

#token
$router->addRoute('auth/token', 'GET', 'LoginApiController', 'getToken'); 

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);