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
            $this->crearxml();
            //si esta definida la cookie de usuario que redireccione al metodo home
            if (isset($_COOKIE['usuario'])) {
                //Redirige al metodo home
                header("Location: ?method=home");
            return;
            }
            //incluir aquí el contenido del archivo login.php que se encuentra en la carpeta vista
            include('views/login.php');    
        }

        public function auth(){
            if (isset($_POST['envio'])) {
                if (!empty($_POST['usuario'])) { 

                    try {
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
                    
                        if(password_verify($_POST['password'],$passworduser)){
                            setcookie("usuario",$_POST["usuario"],time()+3600);
                            header("Location: ?method=home");
                    
                        }
                        

                    } catch (PDOException $e) {
                        echo "Error producido al conectar: " . $e->getMessage();
                    }
                }
    
            }
        }

        public function home(){
            echo "Bienvenido usuario " ;
            echo $_COOKIE['usuario'];
            //incluir aquí el contenido del archivo home.php que encuentra en la carpeta vista
            include('views/home.php');  
        }

        public function crearpersona(){
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];

            try {
                $db = new PDO($this->dsn,$this->usuario, $this->password);
                //se utilizará de nivel de error el que saca una excepcion -> PDO::_EXCEPTION
                //establece el nivel de error quemuestra en la conexion
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                //preparacion por nombre
                //los dos puntos que hay dentro de los parentesis de values son porque la sintaxis es asi 
                //no hace fata que  se llame igual que $clave dentro de values
                $sentencia = $db->prepare("INSERT INTO persona (nombre,apellidos,direccion,telefono) VALUES (:nombre,:apellidos,:direccion,:telefono)");

                $sentencia->bindParam(":nombre", $nombre);  //coge los ultimos valores, si se ha redefinido coge los ultimos
                $sentencia->bindParam(":apellidos", $apellidos);
                $sentencia->bindParam(":direccion", $direccion);
                $sentencia->bindParam(":telefono", $telefono);

                $sentencia->execute(); //ejecutar la sentencia

                header("Location: ?method=home");
                //echo "Contacto de persona añadido correctamente";
            } catch (PDOException $e) {
                echo "Error producido al insertar un contacto: " . $e->getMessage();
            }

        }

        public function mostrarFormuPersona(){
            include('views/crearpersona.php');
        }

        private function crearxml(){
            $datos = simplexml_load_file("agenda.xml");

            if($datos == false){
                echo "<br>No se ha podido leer el xml: ";
                exit();
            }
            
            //se usa este comentario para indicar de que tipo es la variable, ya que el metodo atribute salía como error en visual studio code
            /** @var SimpleXMLElement $contacto*/ 
            foreach ($datos->children() as $contacto){
                $atributo = $contacto->attributes();
                print_r($atributo);
            }
        }
     }