<?php 
    //para crear una conexion desde php a msql
    $dsn = "mysql:dbname=demo;host=db";
    $usuario = "dbuser";
    $password = "secret";

    /*
        - 1. preparar la consulta -> prepare
        - 2. vincular los datos ->bindParam / bindValue
        - 3. ejecutar la sentencia -> execute(); (query, exec)
    */

    try {
        $db = new PDO($dsn,$usuario, $password);
        //se utilizará de nivel de error el que saca una excepcion -> PDO::_EXCEPTION
        //establece el nivel de error quemuestra en la conexion
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //preparacion por nombre
        //los dos puntos que hay dentro de los parentesis de values son porque la sintaxis es asi 
        //no hace fata que  se llame igual que $clave dentro de values
        //$sentencia = $db->prepare("INSERT INTO credenciales (nombreusu,password) VALUES (:nombre,:clave)");
        //$nombre = "Juan";
        //$clave1 = "1234";

        //preparacion por posicion 
        $sentencia = $db->prepare("INSERT INTO credenciales (nombreusu,password) VALUES (?, ?)");

        $nombre = "Pedro";
        $clave1="789";

        $sentencia->bindParam(1, $nombre);  //coge los ultimos valores, si se ha redefinido coge los ultimos
        
        $sentencia->bindParam(2,$clave1);

        //asociar el valor recogido de la variable con la variable dinamica que se establece. Contiene un apuntador, va a coger los ultimos datos a los que apunte
        //$sentencia->bindParam(":nombre", $nombre);
        
        //$sentencia->bindParam(":clave",$clave1);

        //estos dos sacan el valor definido primeramente aunque se haya redefinido despues 
        //$sentencia->bindValue(":nombre", $nombre);
        
        //$sentencia->bindValue(":clave",$clave1);

        $nombre = "Alicia";
        $clave1 = "sombrerero";
        //Redefinir las variables
        
        $sentencia->execute(); //ejecutar la sentencia
        echo "<h2>Exito</h2>";

    } catch (PDOException $e) {
        echo "Error producido al conectar: " . $e->getMessage();
    }

    