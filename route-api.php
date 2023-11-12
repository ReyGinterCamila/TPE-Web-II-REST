<?php
    require_once 'app/Controllers/api.products.controller.php';
    require_once 'app/Controllers/api.categories.controller.php';
    require_once 'app/Controllers/api.login.controller.php';
    require_once 'libs/router.php';
    require_once "initial.php";
    
    // CONSTANTES PARA RUTEO
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
    define("LOGIN", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/login');
    define("LOGOUT", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/logout');

    $r = new Router();

    // rutas
    //HOME
    $r->addRoute("home", "GET", "ProductsController", "Home");
    $r->addRoute("category", "GET", "CategorysController", "HomeCategorys");
    $r->addRoute("filterCategory", "POST", "ProductsController", "FilterProductsByCategory");
    $r->addRoute("itemDetail/:ID", "GET", "ProductsController", "ItemDetail");
    //LOGIN
    $r->addRoute("login", "GET", "LoginController", "Login");
    $r->addRoute("verify", "POST", "LoginController", "VerifyUser");
    $r->addRoute("admin", "GET", "LoginController", "ShowAdmin");
    $r->addRoute("logout", "GET", "LoginController", "Logout");
    //PRODUCTOS
    $r->addRoute("insert", "POST", "ProductsController", "InsertProduct");
    $r->addRoute("delete/:ID", "GET", "ProductsController", "DeleteProduct"); 
    $r->addRoute("edit/:ID", "GET", "ProductsController", "EditProduct");
    $r->addRoute("update/:ID", "POST", "ProductsController", "UpdateProduct");
    //CATEGORIAS   
    $r->addRoute("insertCategory", "POST", "CategorysController", "InsertCategory");
    $r->addRoute("deleteCategory/:ID", "GET", "CategorysController", "DeleteCategory");
    $r->addRoute("editCategory/:ID", "GET", "CategorysController", "EditCategory");
    $r->addRoute("updateCategory/:ID", "POST", "CategorysController", "UpdateCategory");

    //Ruta por defecto.
    $r->setDefaultRoute("ProductsController", "Home");

    //run
    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
  
/*
// Crea el router
$router = new Router();

// Define la tabla de ruteo
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

// Rutea
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
*/