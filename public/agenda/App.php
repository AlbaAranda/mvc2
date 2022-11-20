<?php

    class App{
        
        //constructor de la clase App donde a $nameApp se le da el valor del string indicado
        public function __construct($name = "Aplicación PHP") {
            
            $this->name = $name;
            $this->dsn = "mysql:dbname=agenda;host=db";
            $this->usuario = "root";
            $this->password = "password";

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
        
            return;
            }
            //incluir aquí el contenido del archivo login.php que se encuentra en la carpeta vista
            include('views/login.php');    
        }

        public function auth(){
            if (isset($_POST['envio'])) {
                if (!empty($_POST['usuario'])) { 

                   /* try {
                        $db = new PDO($this->dsn,$this->usuario, $this->password);
                        //se utilizará de nivel de error el que saca una excepcion -> PDO::_EXCEPTION
                        //establece el nivel de error quemuestra en la conexion
                        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                        //preparacion por nombre
                        //los dos puntos que hay dentro de los parentesis de values son porque la sintaxis es asi 
                        //no hace fata que  se llame igual que $clave dentro de values
                        $sentencia = $db->prepare("SELECT *  FROM credenciales WHERE usuario=:usuario");

                        $sentencia->bindParam(":usuario", $_POST['usuario']);  //coge los ultimos valores, si se ha redefinido coge los ultimos
                        
                        $sentencia->execute(); //ejecutar la sentencia
                        //trae los datos de la query
                        $resultado = $sentencia->fetch();

                        $passworduser = $resultado['password'];
                    
                        if(password_verify($_POST['password'],$passworduser)){*/
                         setcookie("usuario",$_POST["usuario"],time()+3600);
                    
                       /* }
                        

                    } catch (PDOException $e) {
                        echo "Error producido al conectar: " . $e->getMessage();
                    }*/
                }
    
            }
        }

        public function home(){
            
            //incluir aquí el contenido del archivo home.php que encuentra en la carpeta vista
            echo "hola";
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