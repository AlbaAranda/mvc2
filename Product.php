<?php 
//Fichero que simula el modelo con datos  
    class Product{
        const PRODUCTS =[
            array(1,'Cortacesped'),
            array(2,'Pizarra'),
            array(3,'Billar'),
            array(4, 'Dardos')
        ];

    function __Construct() { /*cons vacio */ }

    //devuelve todos los productos
    public static function all()
    {

        return Product::PRODUCTS;

    }

    //devolver un producto parcticular
    public function find($id){
        return Product::PRODUCTS[$id-1];
    }
    }