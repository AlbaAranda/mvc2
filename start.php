<?php
    use \Core\App;
    /*echo "<h2>Contenido Privado</h2>";*/

    // /recurso/accion/parametro
        //recurso: controladores
        //accion: metodos de los controladores
        //parametros: find->ide de producto
    
    //require "core/App.php";

    //autoload de composer
    require 'vendor/autoload.php';

    $app = new App();

    /*$app = new Controller();

    //llamar a los métodos del controlador 


    //1 - recoger el metodo que pasan como parametro y si no
    //especifican ningun cargar el metodo home
    
    if(isset($_GET["method"])){
        $method = $_GET["method"]; //show, find, create,  update
        
    }
    else{
        $method= "home";
    }

    //2 - verificar que el metodo introducido existe
    if(method_exists($app, $method)){
        $app->$method();
    }
    else{
        //devuelve el codigo de respuesta que tu le digas
        http_response_code(404);
        die("Método no encontrado"); //exit //acaba la ejecucion del programa y muestra un mensaje
    }

    */
