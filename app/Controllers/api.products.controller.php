<?php
    require_once 'api.login.controller.php';
    require_once(__DIR__ . '/../Views/api.products.view.php');
    require_once(__DIR__ . '/../Views/api.responseHandler.php');
    require_once(__DIR__ . '/../Models/api.products.model.php');
    require_once(__DIR__ . '/../Models/api.categories.model.php');
    require_once(__DIR__ . '/../helpers/api.auth.helper.php');

class ProductsController {
    private $productsModel;
    private $authHelper;
    private $view;
    private $categoriesModel;
    private $model;  // Falta la inicialización de este objeto

    private $loginControl;
    private $loginView;

    function __construct() {
        $this->productsModel = new ProductsModel();
        $this->authHelper = new AuthHelper();
        $this->view = new ProductsView();
        $this->categoriesModel = new CategoriesModel();  // Inicializar $categorysModel
        $this->model = new ProductsModel();  // Inicializar $model
        $this->loginView = new LoginView();
        $this->loginControl = new LoginApiController();
    }

    // LLAMA AL HOME
    /* function Home() {
        $categorys = $this->categoriesModel->GetCategories();
        $products = $this->productsModel->GetProducts();  // Usar $this->productsModel
        $this->view->ShowHome($products, $categorys);
    }
    */

    // CREA UN NUEVO PRODUCTO
    function CreateProduct($params = []) {
        $user = $this->authHelper->currentUser();
        $logueado = $this->loginControl->getToken();
        if ($logueado) {
            if ((!empty($_POST['input_product']) && !empty($_POST['input_description'])) && (!empty($_POST['input_material']) && !empty($_POST['input_price'])) && (!empty($_POST['input_stock']) && !empty($_POST['select_category']))) {
                $product = $_POST['input_product'];
                $description = $_POST['input_description'];
                $material = $_POST['input_material'];
                $price = $_POST['input_price'];
                $stock = $_POST['input_stock'];
                $category = $_POST['select_category'];
                $this->model->InsertProduct($product, $description, $material, $price, $stock, $category);
            }
            $this->view->ShowLocation('admin');
        } else {
            $this->loginView->ShowLogin();
        }
    }

    // ACTUALIZA UN PRODUCTO
    function Update($params = null) {
        $logueado = $this->loginControl->getToken();
        if ($logueado) {
            if ($params !== null) {
                $product_id = $params[':ID'];
                $product = $this->model->GetProductById($product_id);
                if (!empty($_POST['edit_product']) && !empty($_POST['edit_description']) && !empty($_POST['edit_material']) && !empty($_POST['edit_price']) && !empty($_POST['edit_stock']) && !empty($_POST['select_category'])) {
                    $product = $_POST['edit_product'];
                    $description = $_POST['edit_description'];
                    $material = $_POST['edit_material'];
                    $price = $_POST['edit_price'];
                    $stock = $_POST['edit_stock'];
                    $category = $_POST['select_category'];
                    $this->model->UpdateProduct($product, $description, $material, $price, $stock, $category, $product_id);
                }
                $this->view->ShowLocation('admin');
            } else {
                
                $this->loginView->ShowLogin();
        }
    }
    }}
?>
