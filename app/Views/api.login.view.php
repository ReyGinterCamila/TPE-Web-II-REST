<?php

    require_once "./libs/smarty/Smarty.class.php";

    class LoginView{
        private $title;

        function __construct(){
            $this->title = "Tabla de productos";
        }
        //MUESTRA EL LOGIN
        function ShowLogin($message = NULL){
        }
        //MUESTRA LA PAGINA PARA EL ADMIN
        function ShowVerify($products, $categorys){
        }
    }
?>