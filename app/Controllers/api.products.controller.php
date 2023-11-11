<?php
    require_once "app/View/api.products.view.php";
    require_once "app/View/api.login.view.php";
    require_once "app/Model/api.products.model.php";
    require_once "app/Model/app.categories.model.php";
    require_once "app/Controller/app.login.montroller.php";

    class ProductsController{

        private $view;
        private $model;
        private $categorysModel;
        private $loginView;
        private $loginControl;

        function __construct(){
            $this->view = new ProductsView();
            $this->model = new ProductsModel();
            $this->categorysModel = new CategorysModel();
            $this->loginView = new LoginView();
            $this->loginControl = new LoginController();
        }
        //LLAMA AL HOME
        function Home(){
            $categorys = $this->categorysModel->GetCategorys();
            $products = $this->model->GetProducts();
            $this->view->ShowHome($products, $categorys);
        }
        //INSERTA NUEVO PRODUCTO
        function InsertProduct(){
            $logueado = $this->loginControl->checkLoggedIn();
            if($logueado){
                if ((!empty($_POST['input_product']) && !empty($_POST['input_description'])) && (!empty($_POST['input_material']) && !empty($_POST['input_price'])) && (!empty($_POST['input_stock']) && !empty($_POST['select_category']))) {
                    $product = $_POST['input_product'];
                    $description = $_POST['input_description'];
                    $material = $_POST['input_material'];
                    $price = $_POST['input_price'];
                    $stock = $_POST['input_stock'];
                    $category =  $_POST['select_category'];
                $this->model->InsertProduct($product,$description,$material,$price,$stock,$category);
                }
                $this->view->ShowLocation('admin');
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //ELIMINA PRODUCTO POR ID
        function DeleteProduct($params = null){
            $logueado = $this->loginControl->checkLoggedIn();
            if($logueado){
                $product_id = $params[':ID'];
                $this->model->DeleteProduct($product_id);
                $this->view->ShowLocation('admin');
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //LLAMA LA VISTA PARA EDITAR UN PRODUCTO POR ID
        function EditProduct($params = null){
            $logueado = $this->loginControl->checkLoggedIn();
            if($logueado){
                $product_id = $params[':ID'];
                $categorys = $this->categorysModel->GetCategorys();
                $product = $this->model->GetProductById($product_id);
                $this->view->ShowEditProduct($product, $categorys); 
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //LLAMA A ACTUALIZAR UN PRODUCTO
        function UpdateProduct($params = null){
            $logueado = $this->loginControl->checkLoggedIn();
            if($logueado){
                $product_id = $params[':ID'];
                $product = $this->model->GetProductById($product_id);
                if (!empty($_POST['edit_product']) && !empty($_POST['edit_description']) && !empty($_POST['edit_material']) && !empty($_POST['edit_price']) && !empty($_POST['edit_stock']) && !empty($_POST['select_category'])) {
                    $product = $_POST['edit_product'];
                    $description = $_POST['edit_description'];
                    $material = $_POST['edit_material'];
                    $price = $_POST['edit_price'];
                    $stock = $_POST['edit_stock'];
                    $category = $_POST['select_category'];
                    $this->model->UpdateProduct($product,$description,$material,$price,$stock,$category,$product_id);
                }
                $this->view->ShowLocation('admin');
                // echo($category);
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //LLAMA AL FILTRO DE LOS PRODUCTOS POR CATEGORIA
        function FilterProductsByCategory(){
            if (isset($_POST['select_category'])) {
                $category_id = $_POST['select_category'];
                $products = $this->model->GetProductsByCategory($category_id);
                $categorys = $this->categorysModel->GetCategorys();
                $this->view->ShowHome($products, $categorys);
            }
        }
        //LLAMA A LA VISTA EN DETALLE DE UN PRODUCTO
        function ItemDetail($params = null){
            $product_id = $params[':ID'];
            $product = $this->model->GetProductById($product_id);
            $category_id = $product->id_categoria;
            $category = $this->categorysModel->GetCategoryById($category_id);
            $this->view->ShowItemDetail($product, $category); 
        }
    }
?>