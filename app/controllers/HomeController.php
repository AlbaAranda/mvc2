<?php   

    namespace App\Controllers;
    //no se puede poner ni comentarios delante del namespace, ya que incluso eso dará error
    class HomeController{
        
        function __construct()
        {
            echo "<br>Constructor clase HOMEONTROLLER";

        }// fin constructor

        //todos los controladores por defecto tiene que tener un metodo index
        function index(){
            echo "<br>Dentro index HOMECONTROLLER";
            require "../app/views/home.php";

            // metodo home de Controller de mvc00

        } //fin del metodo index

        function home(){
            echo "<br>Dentro de show de HOMECONTROLLER";
           
        } //fin del metodo show

    } //fin clase