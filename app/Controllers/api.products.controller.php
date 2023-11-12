<?php
    require_once "app/View/api.products.view.php";
    require_once "app/View/api.responseHandle.view.php";
    require_once "app/Model/api.products.model.php";
    require_once "app/Model/app.categories.model.php";
    require_once "app/Controller/app.login.controller.php";
    require_once "helpers/api.auth.helper.php";

    class ProductsController{
        private $productsModel;
        private $authHelper;
        private $view;
        private $categorysModel;
        private $model;
        private $loginControl;
        private $loginView;

        function __construct() {
            $this->productsModel = new ProductsModel();
            $this->authHelper = new AuthHelper();
            $this->view = new ProductsView();
            $this->loginView = new LoginView();
            $this->loginControl = new LoginApiController();
        }

        //LLAMA AL HOME
        function Home(){
            $categorys = $this->categorysModel->GetCategories();
            $products = $this->model->GetProducts();
            $this->view->ShowHome($products, $categorys);
            
        }

        function create($params = []) {
            $user = $this->authHelper->currentUser();
            $logueado = $this->loginControl->getToken();
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

        function Update($params = null){
            $logueado = $this->loginControl->getToken();
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
        //ELIMINA PRODUCTO POR ID
        function DeleteProduct($params = null){
            $logueado = $this->loginControl->getToken();
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
            $logueado = $this->loginControl->getToken();
            if($logueado){
                $product_id = $params[':ID'];
                $categorys = $this->categorysModel->GetCategories();
                $product = $this->model->GetProductById($product_id);
                $this->view->ShowEditProduct($product, $categorys); 
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //LLAMA A ACTUALIZAR UN PRODUCTO
        
        }
        //LLAMA AL FILTRO DE LOS PRODUCTOS POR CATEGORIA
        function FilterProductsByCategory(){
            if (isset($_POST['select_category'])) {
                $category_id = $_POST['select_category'];
                $products = $this->model->GetProductsByCategory($category_id);
                $categorys = $this->categorysModel->GetCategories();
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