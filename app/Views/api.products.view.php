<?php

    require_once "./libs/smarty/Smarty.class.php";

    class ProductsView{

        private $title;
        private $titleEdit;
        private $titleCategory;
        
        function __construct(){
            $this->title = "Tabla de productos";
            $this->titleEdit = "Editar producto";
            $this->titleCategory = "Tabla de categorías";
        }
        //REDIRECCIONA LAS CONSTANTES PARA RUTEO 
        function ShowLocation($action){
            header("Location: ".BASE_URL.$action);
        }
        //MUESTRA EL HOME
        function ShowHome($products, $categorys){
        }
        //VISTA PARA EDITAR UN PRODUCTO
        function ShowEditProduct($product, $categorys){
         }
        //VISTA DE UN PRODUCTO EN DETALLE - TABLA PRODUCTO Y TABLA CATEGORIA
        function ShowItemDetail($product, $category){
        }
    }
?>