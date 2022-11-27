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
            if (isset($_SESSION['usuario'])) {
                //Redirige al metodo home
                header("Location: ?method=home");
            return;
            }
            //incluir aquí el contenido del archivo login.php que se encuentra en la carpeta vista
            include('views/login.php');    
        }

        //metodo para comprobar input usuario no esta vacio, y si es asi coge el usuario de la base de datos. A continuación en el ultimo if  valida la contraseña
        public function auth(){
            if (isset($_POST['envio'])) {
                if (!empty($_POST['usuario'])) { 

                    try {
                        $db = new PDO($this->dsn,$this->usuario, $this->password);
                        //se utilizará de nivel de error el que saca una excepcion -> PDO::_EXCEPTION
                        //establece el nivel de error quemuestra en la conexion
                        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                        //preparacion por nombre
                        $sentencia = $db->prepare("SELECT *  FROM credenciales WHERE usuario=:usuario");

                        $sentencia->bindParam(":usuario", $_POST['usuario']);  //coge los ultimos valores, si se ha redefinido coge los ultimos
                        
                        $sentencia->execute(); //ejecutar la sentencia

                        //guardar los datos de la consulta en una variable
                        $resultado = $sentencia->fetch();

                        $passworduser = $resultado['password'];
                    
                        //validar la constraseña
                        if(password_verify($_POST['password'],$passworduser)){
                            //crear la cookie del usuario una vez validada la contraseña
                            //setcookie("usuario",$_POST["usuario"],time()+3600);
                            session_start();
                            $_SESSION['usuario'] = $_POST['usuario'];
                            header("Location: ?method=home");
                    
                        } 

                    } catch (PDOException $e) {
                        echo "Error producido al conectar: " . $e->getMessage();
                    }
                }
    
            }
        }

        //metodo para mostrar un saludo una vez logueado con el nombre del usuario e incluir una lista con las funciones disponibles de la app
        public function home(){
            session_start();
            echo "Bienvenido usuario " ;
            echo $_SESSION['usuario'];
            echo "<br>";
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

        //metodo para mostrar el formulario para añadir un contacto de persona nuevo 
        public function mostrarFormuPersona(){
            include('views/crearpersona.php');
        }

        //metodo para cargar el xml requerido
        private function crearxml(){
            //cargamos el archivo xml
            $datos = simplexml_load_file("agenda.xml");

            //si no no se encuentra el archivo que se imprima un mensaje de error 
            if($datos == false){
                echo "<br>No se ha podido leer el xml: ";
                exit();
            }
            
            //se usa este comentario para indicar de que tipo es la variable, ya que el metodo atributes() salía como error en visual studio code
            /** @var SimpleXMLElement $contacto*/ 
            
            //sacar todos los nodos hijos del nodo principal
            foreach ($datos->children() as $contacto){
                $atributo = $contacto->attributes();
                
            
                if((string)$atributo['tipo'] === "persona"){
                    
                    try {
                        $db = new PDO($this->dsn,$this->usuario, $this->password);
                        //se utilizará de nivel de error el que saca una excepcion -> PDO::_EXCEPTION
                        //establece el nivel de error quemuestra en la conexion
                        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                        //preparacion por nombre
                        //guardar en una variable la sentencia sql. Se coge el telefono como distintivo ( como si fuera un id unico para cada personal)
                        $sentencia = $db->prepare("SELECT *  FROM persona WHERE telefono=:telefono");

                        $telefono = (string)$contacto->telefono;
                        $sentencia->bindParam(":telefono", $telefono);  //coge los ultimos valores, si se ha redefinido coge los ultimos
                        
                        
                        $sentencia->execute(); //ejecutar la sentencia

                        //trae los datos de la consulta (select)
                        $resultado = $sentencia->fetch();
                    
                        //si el el resultado es nulo, es decir que no existe la persona con el telefono
                        if(!$resultado){
                           
                            $insert = $db->prepare("INSERT INTO persona (nombre,apellidos,direccion,telefono) VALUES (:nombre,:apellidos,:direccion,:telefono)");
                            $nombre = (string)$contacto->nombre;
                            $apellidos = (string)$contacto->apellidos;
                            $direccion = (string)$contacto->direccion;

                            $insert->bindParam(":nombre", $nombre); 
                            $insert->bindParam(":apellidos", $apellidos);
                            $insert->bindParam(":direccion", $direccion);
                            $insert->bindParam(":telefono", $telefono);

                            $insert->execute(); //ejecutar la sentencia
                    
                        }
                        

                    } catch (Exception $e) {
                        echo "Error producido al conectar: " . $e->getMessage();
                    }
                }

                if((string)$atributo['tipo'] === "empresa"){

                    try {
                        $db = new PDO($this->dsn,$this->usuario, $this->password);
                        //se utilizará de nivel de error el que saca una excepcion -> PDO::_EXCEPTION
                        //establece el nivel de error quemuestra en la conexion
                        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                        //preparacion por nombre
                        //guardar en una variable la sentencia sql. Se coge el telefono como distintivo ( como si fuera un id unico para cada personal)
                        $sentencia = $db->prepare("SELECT *  FROM empresa WHERE telefono=:telefono");

                        $telefono = (string)$contacto->telefono;
                        $sentencia->bindParam(":telefono", $telefono);  //coge los ultimos valores, si se ha redefinido coge los ultimos
                        
                        
                        $sentencia->execute(); //ejecutar la sentencia

                        //trae los datos de la consulta (select)
                        $resultado = $sentencia->fetch();
                    
                        //si el el resultado es nulo, es decir que no existe la persona con el telefono
                        if(!$resultado){
                           
                            $insert = $db->prepare("INSERT INTO empresa (nombre,direccion,telefono,email) VALUES (:nombre,:direccion,:telefono,:email)");
                            $nombre = (string)$contacto->nombre;
                            $direccion = (string)$contacto->direccion;
                            $email = (string)$contacto->email;

                            $insert->bindParam(":nombre", $nombre); 
                            $insert->bindParam(":direccion", $direccion);
                            $insert->bindParam(":telefono", $telefono);
                            $insert->bindParam(":email", $email);

                            $insert->execute(); //ejecutar la sentencia
                        }
                        
                    } catch (Exception $e) {
                        echo "Error producido al conectar: " . $e->getMessage();
                    }
                }
            }
        }

        public function buscar(){
            try {
                $db = new PDO($this->dsn,$this->usuario, $this->password);
                //se utilizará de nivel de error el que saca una excepcion -> PDO::_EXCEPTION
                //establece el nivel de error quemuestra en la conexion
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                //preparacion por nombre
                //guardar en una variable la sentencia sql. Se coge el nombre como distintivo ( como si fuera un id unico para cada personal)
                $sentencia = $db->prepare("SELECT *  FROM persona WHERE nombre=:nombre");

                $nombre = $_POST["nombre"];
                $sentencia->bindParam(":nombre", $nombre);  //coge los ultimos valores, si se ha redefinido coge los ultimos
                
                
                $sentencia->execute(); //ejecutar la sentencia

                //trae los datos de la consulta (select)
                $persona = $sentencia->fetch();
                
                // necesario para mostrar mensaje en la views
                $personaEncontrada = false;
                //si hay un resultado
                if($persona){
                   $personaEncontrada = true;
                }

                require('views/buscarPersona.php');

            } catch (Exception $e) {
                echo "Error producido al buscar una persona: " . $e->getMessage();
            }
        }

        public function showBuscar(){
            include('views/buscarPersona.php');
        }

        public function eliminar(){
            try {
                $db = new PDO($this->dsn,$this->usuario, $this->password);
                //se utilizará de nivel de error el que saca una excepcion -> PDO::_EXCEPTION
                //establece el nivel de error quemuestra en la conexion
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                //preparacion por nombre
                //guardar en una variable la sentencia sql. Se coge el nombre como distintivo ( como si fuera un id unico para cada personal)
                $sentencia = $db->prepare("SELECT *  FROM persona WHERE nombre=:nombre");

                //guardar el nombre de la persona en una variable 
                $nombre = $_POST["nombre"];
                $sentencia->bindParam(":nombre", $nombre);  //coge los ultimos valores, si se ha redefinido coge los ultimos
                
                
                $sentencia->execute(); //ejecutar la sentencia

                //trae los datos de la consulta (select)
                $persona = $sentencia->fetch();
            
                $personaEncontrada = false;

                //si hay un resultado
                if($persona){
                   $personaEncontrada = true;
                   $sentenciaBorrar = $db->prepare("DELETE FROM persona WHERE nombre=:nombre");
                   $sentenciaBorrar->bindParam(":nombre", $nombre);
                   $sentenciaBorrar->execute(); //ejecutar la sentencia

                   $personaEliminada = true;
                }

                require('views/eliminarPersona.php');

            } catch (Exception $e) {
                echo "Error producido al buscar una persona: " . $e->getMessage();
            }
        }

        public function showDelete(){
            include('views/eliminarPersona.php');
        }


        public function update(){
            try {
                $db = new PDO($this->dsn,$this->usuario, $this->password);
                //se utilizará de nivel de error el que saca una excepcion -> PDO::_EXCEPTION
                //establece el nivel de error quemuestra en la conexion
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                //preparacion por nombre
                //guardar en una variable la sentencia sql. Se coge el nombre como distintivo ( como si fuera un id unico para cada personal)
                $sentencia = $db->prepare("UPDATE persona SET  apellidos = :apellidos, direccion = :direccion, telefono = :telefono WHERE nombre = :nombre");

                //guardar el nombre de la persona en una variable 
                $nombre = $_POST["nombre"];
                $sentencia->bindParam(":nombre", $nombre);  //coge los ultimos valores, si se ha redefinido coge los ultimos
                
                $apellidos = $_POST["apellidos"];
                $sentencia->bindParam(':apellidos', $apellidos);

                $direccion = $_POST["direccion"];
                $sentencia->bindParam(':direccion', $direccion);

                $telefono = $_POST["telefono"];
                $sentencia->bindParam(':telefono', $telefono);

                $sentencia->execute(); //ejecutar la sentencia
            
                $personaActualizada = true;


                require('views/actualizarPersona.php');

            } catch (Exception $e) {
                echo "Error producido al buscar una persona: " . $e->getMessage();
            }
        }

        public function buscarPersonaActualizar(){
            try {
                $db = new PDO($this->dsn,$this->usuario, $this->password);
                //se utilizará de nivel de error el que saca una excepcion -> PDO::_EXCEPTION
                //establece el nivel de error quemuestra en la conexion
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                //preparacion por nombre
                //guardar en una variable la sentencia sql. Se coge el nombre como distintivo ( como si fuera un id unico para cada personal)
                $sentencia = $db->prepare("SELECT *  FROM persona WHERE nombre=:nombre");

                $nombre = $_POST["nombre"];
                $sentencia->bindParam(":nombre", $nombre);  //coge los ultimos valores, si se ha redefinido coge los ultimos
                
                
                $sentencia->execute(); //ejecutar la sentencia

                //trae los datos de la consulta (select)
                $persona = $sentencia->fetch();
                
                // necesario para mostrar mensaje en la views
                $personaEncontrada = false;
                //si hay un resultado
                if($persona){
                   $personaEncontrada = true;
                }

                require('views/actualizarPersona.php');

            } catch (Exception $e) {
                echo "Error producido al buscar una persona: " . $e->getMessage();
            }
        }

        public function showUpdate(){
            include('views/actualizarPersona.php');
        }

     }