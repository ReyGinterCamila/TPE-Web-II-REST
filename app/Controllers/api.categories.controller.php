<?php
require_once 'api.controller.php';
require_once (__DIR__ . '/../Models/api.categories.model.php');
require_once(__DIR__ . '/../Models/api.products.model.php');
require_once(__DIR__ . '/../Views/api.categories.view.php');
require_once(__DIR__ . '/../Views/api.products.view.php');
require_once(__DIR__ . '/../Views/api.responseHandler.php');
require_once(__DIR__ . '/../helpers/api.auth.helper.php');

class CategoriesController extends ApiController{
        private $productsView;
        private $ApiResponseHandler;
        private $productosModel;
        private $categoriesModel;
        private $loginView;
        private $loginControl;
        private $authHelper;

        function __construct() {
            $this->productsView = new ProductsView();
            $this->ApiResponseHandler = new ApiResponseHandler();
            $this->productosModel = new ProductsModel();
            $this->categoriesModel = new CategoriesModel();
            $this->loginView = new LoginView();
            $this->authHelper = new authHelper();
    }

    function getAll($params = []) {
        if (empty($params)) {
            $sort = 'id_categoria';
            $order = 'asc';

            if (isset($_GET['order'])) {
                $order = $_GET['order'];
                if ($order != 'asc' && $order != 'desc') {
                    $order = 'asc';
                }
            }

            if (isset($_GET['sort'])) {
                $sort = $_GET['sort'];
                $columnasValidas = array('id_categoria', 'nombre_categoria'); 
                if (!in_array($sort, $columnasValidas)) {
                    $sort = 'id_categoria';
                }
            }

            $categories = $this->categoriesModel->GetCategories($order, $sort);
            $this->ApiResponseHandler->response($categories, 200);
            return;
        } else {
            $categories = $this->categoriesModel->GetCategoryById($params[':ID']);
            if (!empty($categories)) {
                $this->ApiResponseHandler->response($categories, 200);
                return;
            } else {
                $this->ApiResponseHandler->response('La categoria con el id ' . $params[':ID'] . ' no existe.',404);
                return;
            }
        }
    }
    // INSERTAR NUEVA CATEGORIA
    function create($params = [])
    {
        $logueado = $this->loginControl->checkLoggedIn();
        if($logueado){
                if (!empty($_POST['input_category'])) {
                    $category = $_POST['input_category'];
                    $this->categoriesModel->InsertCategory($category);
                }
                $this->productsView->ShowLocation('admin');
            }else{
                $this->loginView->ShowLogin();
            }
        }

    // ELIMINAR CATEGORIA POR ID
        function delete($params = null){
            $logueado = $this->loginControl->checkLoggedIn();
            if($logueado){
                $category_id = $params[':ID'];
                $this->categoriesModel->DeleteCategory($category_id);
                $this->productsView->ShowLocation('admin');
            }else{
                $this->loginView->ShowLogin();
            }
        }

    //LLAMAR A LA VISTA PARA EDITAR UNA CATEGORIA POR ID
        function edit($params = null){
            $logueado = $this->loginControl->checkLoggedIn();
            if($logueado){
                $category_id = $params[':ID'];
                $category = $this->categoriesModel->GetCategoryById($category_id);
                //$this->categoriesView->ShowEditCategory($category);
            }else{
                $this->loginView->ShowLogin();
            }
        }

    // LLAMAR A ACTUALIZAR UNA CATEGORIA
    function update($params = [])
    {
        $logueado = $this->loginControl->checkLoggedIn();
            if($logueado){
                $category_id = $params[':ID'];
                if (!empty($_POST['edit_category'])) {
                    $category = $_POST['edit_category'];
                    $this->categoriesModel->UpdateCategory($category,$category_id);
                }
                $this->productsView->ShowLocation('admin');
            }else{
                $this->loginView->ShowLogin();
            }
    }
} 

?>
