<?php

class CategoriesView {
  private $title;
        
  function __construct(){
      $this->title = "Tabla de categorías";
  }
  //MUESTRO LA TABLA DE CATEGORIAS
  function ShowCategorys($categorys){
      //$smarty = new Smarty();
      //$smarty->assign('titulo', $this->title);
      //$smarty->assign('categorys', $categorys);
      // muestro el template 
      //$smarty->display('templates/categorys.tpl');
  }
  //VISTA PARA EDITAR UNA CATEGORIA
  function ShowEditCategory($category){
      //$smarty = new Smarty();
      //$smarty->assign('category', $category);
      // muestro el template 
      //$smarty->display('templates/editCategory.tpl');  
  }
}
?>