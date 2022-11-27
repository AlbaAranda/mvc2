<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- incluir la lista de opciones de home-->
    <?php include('home.php')?> 

    <form name="formuBuscaPersona" action="?method=buscar" method="post">
        <h2>Buscar persona:</h2>
        <label>Nombre: </label>
        <input type="text" id="nombre" name="nombre">
        <input type="submit" name="envio" id="envio" value="Enviar Datos">
    </form>
    <br><br>
    <?php 
        if(isset($personaEncontrada) && !$personaEncontrada){
            echo "No se ha encontrado a la persona consultada";
        }

        if($persona){
            echo "<br>Nombre: " . $persona['nombre'];
            echo "<br>Apellidos: " .$persona['apellidos'];
            echo "<br>Dirección: " . $persona['direccion'];
            echo "<br>Teléfono: " . $persona['telefono'];
        } ?>
</body>
</html>