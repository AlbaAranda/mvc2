<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- incluir la lista de opciones de home-->
    <?php include('home.php');?> 

    <form name="formuEliminaPersona" action="?method=eliminar" method="post">
        <h2>Eliminar una persona:</h2>
        <?php 
        //para mostrar en formulario justo en este espacioi los nombre y apellidos que están en la base de datos
        foreach($personas as $persona){
            echo "Nombre: " . $persona['nombre'] . "." . "   Apellidos: " . $persona['apellidos'] . "<br>";
        }?>
        <br>
        <label>Nombre: </label>
        <input type="text" id="nombre" name="nombre">
        <input type="submit" name="envio" id="envio" value="Eliminar contacto">
    </form>
    <br><br>
    <!--se añade este trozo de codigo en php para que se muestre si se ha encontrado y eliminado o no con exito-->
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