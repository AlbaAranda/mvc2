<?php
        require "../bbddconexion.php";
    
        /*
        /recuros/metodo/parametro
        metodos->Metodos o funciones dentro del controlador
        parametros->opcional
        */
        
        $sql = "select nombreusu,password from credenciales";
        $registros = $bd->query($sql);
        echo "<br>Número de registros devueltos: " . $registros->rowCount();
        if($registros->rowCount() >0){
            foreach($registros as $fila){
                echo "<br>Nombre de usuario: " . $fila["nombreusu"];
                echo "<br>Password: " . $fila["password"];
            }
        }
        else{
            echo "<br>NO se ha devuelto ninguna fila";
        }


    /*continuacion del ejercicio: 
        insertar una nueva fila en credenciales ; usuario2 : error (cifrada)

        actualizar fila en credenciales

        borrar fila en credenciales
    

try{
        $bd = new PDO($dsn,$usuario,$clave);
        $sql = "insert into usuario2,password2 from credenciales";
        $registros = $bd->query($sql);
        echo "<br>Número de registros devueltos: " . $registros->rowCount();
        if($registros->rowCount() >0){
            foreach($registros as $fila){
                echo "<br>Nombre de usuario: " . $fila["nombreusu"];
                echo "<br>Password: " . $fila["password"];
            }
        }
        else{
            echo "<br>NO se ha devuelto ninguna fila";
        }
    }
    catch(PDOException $e){
        echo "Mensaje de la excepcion: " . $e->getMessage();
    }
*/