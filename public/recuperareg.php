<?php
    class Login{

        //estos atributos se llaman igual que los campos aunqe no es obligatorio
        protected $nombreusu = null; // se debe llamar igual que la columna de bbdd
        protected $password = null; 


        /*
        1- preparar la consulta -> prepare 
        2- establecer el modo de recuperación: FETCH_CLASS, FETCH_ASSOC
        3- ejecutar la consulta -> execute
        4- Recuperar los registros : fetch (un registro) / fetchAll (devuelv todos los registros)
        */
         
        public static function all(){
            $dsn = "mysql:host=db;dbname=demo";
            $usuario = "dbuser";
            $password = "secret";

            try {
                $db = new PDO($dsn,$usuario,$password);
                //establece el nivel de error que muestra en la conexion
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM credenciales";
                $sentencia = $db->prepare($sql);
                //establece la forma de recuperar registro
                $sentencia->setFetchMode(PDO::FETCH_CLASS, "Login");
                $sentencia->execute(); //3- ejecuta la sentencia

                /*
                while($obj =$sentencia->fetch()){
                    //print_r(($obj));
                    echo "<br>NOMBRE: " .  $obj->nombreusu;
                    echo "<br>CONTRASEÑA: " . $obj->password;
                } //fin del while

                */

                $credenciales = $sentencia->fetchAll(PDO::FETCH_CLASS, "Login"); 
                foreach($credenciales as $credencial){
                    echo "<br>NOMBRE: " .  $credencial->nombreusu;
                    echo "<br>CONTRASEÑA: " . $credencial->password;
                }
            } catch (PDOException $e) {
               echo "<br>Error conexión: " . $e->getMessage();
            }
        } //fin all
    } //fin clae

    echo "<h2>Recuperando registros</h2>";
    //porque es estatico, pertenece a la clase
    Login::all();