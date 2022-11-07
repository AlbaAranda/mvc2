<?php
    //conseguir la contraseña de base datos 
    //$dsn --> nombre del serividor y la base de datos a la que cnecto
    //en el terminal: less docker-compose.yml para acceder a datos de la base de datos 
    

    //mysql:dbname=<nombre_bbdd>;host=<ip | nombre;
    $dsn ="mysql:dbname=demo;host=db";

    //usuario y clave o lo sabemos porque hemos creado noostros la base de datos o nos lo tienen que decir 

    $usuario = "dbuser";
    $clave = "secret";

    try{
        $bd = new PDO($dsn,$usuario,$clave);
     
    }
    catch(PDOException $e){
        echo "Mensaje de la excepcion: " . $e->getMessage();
        exit();
    }