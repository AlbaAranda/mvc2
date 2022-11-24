<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <ul>
        <pre>
    <?php 
    //se guarda el contenido de la cookie (la lista de deseos) e una variable
    $listadeseos = json_decode($_COOKIE["listadeseos"]);
    //si lista deseo no es nula la lista que la muestsre y que cuente los elementos
    if (!is_null($listadeseos) && count($listadeseos)) {
        foreach ($listadeseos as $posicion => $deseo) {
        echo "<li> Deseo  $posicion: " . $deseo . '</li>';
        }
    } else {
        echo "No hay deseos todavía";
    }
    ?>
    </ul>
    <!-- aquí en action se llama al método new que se encuentra en App.php para enviarle los datos del formulario. 
    En el resto de formulario se realiza lo mismo pero con el método incado en cada caso-->
    <form name="formulariodeseos" action="?method=new" method="post">
    <h1>Lista de Deseos: </h1>
        <p>
        <label for="new">Nuevo deseo</label>
        <input type="text" name="deseo">
        </p>
        <input type="submit" name="envio" id="envio" value="Agregar Deseo">
        <br><br>
    </form>
    <form name="borrar" action="?method=delete" method="post">
        <h3>Borar un deseo</h3>
        <label for="deseo">Indice</label>
        <input type="text" name="indice"> 
        <input type="submit" name="borrar" id="borrar" value="Borrar deseo">
        <br><br>
    </form >
    <form name="vaciar" action="?method=empty" method="post">
        <h3>Vaciar lista</h3>
        <input type="submit" name="vaciar" id="vaciar" value= "Vaciar lista">
        <br><br>
    </form>
    <form name="logout" action="?method=close" method="post">
        <h3>Cerrar la sesion</h3>
        <input type="submit" name="close" id="close" value= "Cerrar Sesión">
    </form>
</body>
</html>
