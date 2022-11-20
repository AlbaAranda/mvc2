<?php
//incluir una vez el contenido de App.php
require_once "App.php";

//se crea un objeto de tipo App
$app = new App;

//con el objeto creado se llama al método run incluido en la clase App
$app->run();