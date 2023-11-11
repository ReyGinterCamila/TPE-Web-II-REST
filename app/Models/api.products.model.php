<?php

    require_once 'config.php';

    class ProductsModel{

        private $db;
        //CONEXIÓN CON LA BDD
        function __construct(){
            $this->db = new PDO("mysql:host=" . 'HOST' . ";dbname=" . 'NAME', 'USER', 'PASSWORD');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        //OBTENGO PRODUCTOS
        function GetProducts(){
            $sentencia = $this->db->prepare("SELECT * FROM producto");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        //BUSCO PRODUCTO POR ID
        function GetProductById($product_id){
            $sentencia = $this->db->prepare("SELECT * FROM producto WHERE id_producto=?");
            $sentencia->execute(array($product_id));
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }
        //INSERTO PRODUCTO
        function InsertProduct($product,$description,$material,$price,$stock,$category){
            $sentencia = $this->db->prepare("INSERT INTO producto(nombre_producto, descripcion, material, precio, stock, id_categoria) VALUES(?,?,?,?,?,?)");
            $sentencia->execute(array($product,$description,$material,$price,$stock,$category));
        }
        //ELIMINO PRODUCTO
        function DeleteProduct($product_id){
            $sentencia = $this->db->prepare("DELETE FROM producto WHERE id_producto=?");
            $sentencia->execute(array($product_id));
        }
        //ACTUALIZO PRODUCTO
        function UpdateProduct($product,$description,$material,$price,$stock,$category,$product_id){
            $sentencia = $this->db->prepare("UPDATE producto SET nombre_producto=?, descripcion=?, material=?, precio=?, stock=?, id_categoria=? WHERE producto.id_producto=?");
            $sentencia->execute(array($product,$description,$material,$price,$stock,$category,$product_id));
        }
        //BUSCO LOS PRODUCTOS QUE COINCIDAN CON EL ID DEL FILTRO POR CATEGORIA
        function GetProductsByCategory($category_id){
            $sentencia = $this->db->prepare("SELECT * FROM producto WHERE id_categoria=?");
            $sentencia->execute([$category_id]);
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>