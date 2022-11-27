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

    <form name="formuBuscaPersona" action="?method=buscarPersonaActualizar" method="post">
        <h2>Buscar persona:</h2>
        <label>Nombre: </label>
        <input type="text" id="nombre" name="nombre">
        <input type="submit" name="envio" id="envio" value="Enviar Datos">
    </form>
    <br><br>
    <!--se añade este trozo de codigo en php para que se muestre si se ha actualizado o no con exito-->
    <?php 
        if(isset($personaEncontrada) && !$personaEncontrada){
            echo "No se ha encontrado a la persona consultada";
        }
        if(isset($personaActualizada)){
            echo "Persona actualizada con éxito";
        }

    ?>
    <!--si la variable persona está definida y no es ni nula ni false que acceda al formulario escrito debajo -->
    <?php if(isset($persona) && $persona): ?> 
        <form name="formupersona" action="?method=update" method="post">
        <h2>Actualizar persona:</h2>
        <label>Nombre: <?php echo $persona['nombre']?></label>
        <!-- Con lo añadido en value se muestra en el formulario por defecto los datos del contacto que se quier actualizar-->
        <input type="text" id="nombre" name="nombre" hidden value= "<?php echo $persona['nombre']?>">
        <label>Apellidos: </label>
        <input type="text" id="apellidos" name="apellidos" value= "<?php echo $persona['apellidos']?>">
        <label>Dirección: </label>
        <input type="text" id="direccion" name="direccion" value= "<?php echo $persona['direccion']?>">
        <label>Teléfono: </label>
        <input type="text" id="telefono" name="telefono" value= "<?php echo $persona['telefono']?>">
        <input type="submit" name="envio" id="envio" value="Actualizar Datos">
    </form>
    <!-- con endif se indica que se cierra el if-->
    <?php endif; ?>
</body>
</html>