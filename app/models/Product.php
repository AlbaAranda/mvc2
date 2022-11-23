<?php 
 namespace App\Models;

 use PD0;
 use Core\Model;
 // para la herencia usamos el use pdo y el core\model

 require_once '../core/Model.php';
 
 /*
 //namespace global es \
//es el modelo
//Fichero que simula el modelo con datos  
    class Product{
        const PRODUCTS =[
            array(1,'Cortacesped'),
            array(2,'Pizarra'),
            array(3,'Billar'),
            array(4, 'Dardos')
        ];

    function __Construct() { /*cons vacio  }

    //devuelve todos los productos con all()
    public static function all()
    {

        return Product::PRODUCTS;

    }

    //devolver un producto parcticular con find()
    public static function find($id){
        return Product::PRODUCTS[$id-1];
    }
    
    }
    TODO ESTO es lo que habia antes, ahora con herencia se hace con la clase siguiente*/
    class Product extends Model{
        public static function all(){ }
        public static function find($id){ }
        public function insert() { }
        public function delete(){ }
        public function save(){}
    }
    