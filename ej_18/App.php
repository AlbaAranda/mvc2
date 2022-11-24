<?php

    class App{

        //constructor de la clase App donde a $nameApp se le da el valor del string indicado
        public function __construct($name = "Aplicación PHP") {
            
            $this->name = $name;
        }
        
        /*con esta función se ejecuta la aplicación. Si el metodo está definido, se ejecuta dicho método
        sino se ejecuta el método login( que se incluye en el archivo login de la carpeta vista). La primera vez que se carga la página 
        entra por el else (el login) ya que aun no se ha seleccionado ningún método */
        public function run(){
            if (isset($_GET['method'])) {
            $method = $_GET['method'];
            } else {
            $method = 'login';
            }
        
            $this->$method();      
        }
        
        public function login(){
            //si esta definida la cookie de usuario que redireccione al metodo home
            if (isset($_COOKIE['usuario'])) {
                //Redirige al metodo home
                header('Location: ?method=home');
            return;
            }
            //incluir aquí el contenido del archivo login.php que se encuentra en la carpeta vista
            include('vista/login.php');    
        }

        public function auth(){
            if (isset($_POST['envio'])) {
                if (!empty($_POST['usuario'])) { 
                    //se crea la cookie usuario con el valor del input de usuario y con una duración de una hora
                     setcookie("usuario",$_POST["usuario"],time()+3600);
                     //no se crea la cookie de password por seguridad
                }
        
                if(!empty($_POST["usuario"]) && !empty($_POST["password"])){
                    //Redirige al metodo home
                    header("Location: ?method=home");
                }
            }
        }

        public function home(){
            if(isset($_COOKIE["listadeseos"])){
                //con json_decode guardamos el contenido de la cookie en una variable
                $listadeseos = json_decode($_COOKIE["listadeseos"]);
                print_r($listadeseos);
            }
            //incluir aquí el contenido del archivo home.php que encuentra en la carpeta vista
            include("vista/home.php");
        }

        public function new(){
            //se crea un array vacío
            $listadeseos = [];
            //si existe la cookie sacar el valor
            if(isset($_COOKIE["listadeseos"])){
                //con json_decode guardamos el contenido de la cookie en una variable
                $listadeseos = json_decode($_COOKIE["listadeseos"]);
            }
            //añadir el nuevo deseo al array 
            $listadeseos[]= $_POST["deseo"];
            //se crea la cookie listadeseos. El valor de la cookie es el valor de $listadeseos
            setcookie("listadeseos",json_encode($listadeseos), time()+3600);
            //redirección al método home
            header("Location: ?method=home");
        }

        public function delete(){
            if(isset($_COOKIE["listadeseos"])){
                //con json_decode guardamos el contenido de la cookie en una variable
                $listadeseos = json_decode($_COOKIE["listadeseos"]);
                //borrar el valor del indice indicado
                unset($listadeseos[$_POST["indice"]]);
                /*la función array_values() oge los valores de un array y los devuelve en una variable. Despues de haber borrado un valor se cogen
                 los valores restantes y se meten en otro array,de ahí que no queden posiciones vacias */
                $listadeseos = array_values($listadeseos);
                //se crea la cookie listadeseos. enconde pasa el array de $listadeseos a string
                setcookie("listadeseos",json_encode($listadeseos), time()+3600);
            }
            //redirección al método home
            header("Location: ?method=home");
        }

        public function empty(){
            if(isset($_COOKIE["listadeseos"])){
                //con json_decode guardamos el contenido de la cookie en una variable
                $listadeseos = json_decode($_COOKIE["listadeseos"]);
                //vaciar la lista de deseos
                $listadeseos = [];
                //se crea la cookie listadeseos. enconde pasa el array de $listadeseos a string
                setcookie("listadeseos",json_encode($listadeseos), time()+3600);
            }
            //redirección al método home
            header("Location: ?method=home");
        }

        public function close(){
            //borrar la cookie usuario
            setcookie("usuario","", 1);
            //redirección al método login 
            header("Location: ?method=login");
        }
     }
        