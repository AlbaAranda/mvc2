<?php
    
    //Controlador
    require_once "Product.php";

    class Controller 
{
   function __construct()
   {
       //constructor por ahora vacio
   } 

   /* funcion que :
    -recoge todos los prodctos
    -llama a vista de inventario*/ 
   public function home(){
        $products = \Product::all();
        require "views/home.php";
   }

   /**funcion que 
    -  mostrar un producto en particular, el id como parametro
    - llamar vista de un producto en concreto
    */
    public function show(){
        $id = $_GET["id"];
        $product = \Product::find($id); //vendrá de start.php
        require "views/show.php";
    }
}
