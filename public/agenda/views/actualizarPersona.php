<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
      
    <form name="formuBuscaPersona" action="?method=buscarPersonaActualizar" method="post">
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
        if(isset($personaActualizada)){
            echo "Persona actualizada con éxito";
        }

    ?>
    <!--si la variable persona está definida y no es ni nula ni false que acceda al formulario escrito debajo -->
    <?php if(isset($persona) && $persona): ?> 
        <?php echo $persona['direccion']; ?>
        <form name="formupersona" action="?method=update" method="post">
        <h2>Actualizar persona:</h2>
        <label>Nombre: <?php echo $persona['nombre']?></label>
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