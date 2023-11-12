<?php
    require_once 'app/Controller/api.products.controller.php';
    require_once 'app/Controller/api.categorys.controller.php';
    require_once 'app/Controller/api.login.controller.php';
    require_once 'libs/router.php';
    
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
?>