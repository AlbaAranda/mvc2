<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
      
    <form name="formuEliminaPersona" action="?method=eliminar" method="post">
        <h2>Eliminar una persona:</h2>
        <label>Nombre: </label>
        <input type="text" id="nombre" name="nombre">
        <input type="submit" name="envio" id="envio" value="Eliminar contacto">
    </form>
    <br><br>
    <?php 
        if(isset($personaEncontrada) && !$personaEncontrada){
            echo "No se ha encontrado a la persona consultada";
        }
        if(isset($personaEliminada)){
            echo "Se ha eliminado un contacto persona con éxito";
        }
    ?>
</body>
</html>