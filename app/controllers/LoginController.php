<?php   

    namespace App\Controllers;
    
    class LoginController{
        
        function __construct()
        {
            echo "<br>Constructor clase LOGINCONTROLLER";

        }// fin constructor

        //todos los controladores por defecto tiene que tener un metodo index
        function index(){
            echo "<br>Dentro index LOGINCONTROLLER";
            // metodo home de Controller de mvc00
        } //fin del metodo index

        function login(){
            echo "<br>Dentro de login de LOGINCONTROLLER";
        } //fin del metodo show

    } //fin clase