<?php 
    namespace App\Controllers;

    use App\Models\Product;
    use Dompdf\Dompdf;

   // require_once "../Product.php";

    class ProductController{
        
        function __construct()
        {
            echo "<br>Constructor clase PRODUCTCONTROLLER";

        }// fin constructor

        //todos los controladores por defecto tiene que tener un metodo index
        function index(){
           // echo "<br>Dentro index PRODUCTCONTROLLER";
            // metodo home de Controller de mvc00
            $products = Product::all();
            //require "../views/product.php";
        } //fin del metodo index

        function show(){
           // echo "<br>Dentro de show de PRODUCTCONTROLLER";
           $id = $_GET["id"];
           $product = Product::find($id); //vendrá de star.php
            require "../views/show.php";
        } //fin del metodo show

        public function pdf(){
            //$products = Product::all();
            //include_once "./vendor/autoload.php";
            
            $dompdf = new Dompdf();
            $dompdf->loadHtml('<h1>Hola mundo</h1><br>');
            header("Content-type: application/pdf");
            header("Content-Disposition: inline; filename=documento.pdf");
            $dompdf->render();
            $contenido = $dompdf->stream();
    
        }
    } //fin clase