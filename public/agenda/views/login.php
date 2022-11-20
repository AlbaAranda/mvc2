<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 18</title>
</head>
<body>
    <h3>Ejercicio 18</h3>
    <h3>Login</h3>
    <!--con el action se llama al metodo auth para enviarle los datos del formulario -->
    <form name="formulario" action="?method=auth" method="post">
        <p>
            <label for="usuario">Introduce usuario: </label>
            <input type="text" name="usuario" id="usuario">
        </p>
        <p>
            <label for="password">Introduce contraseña: </label>
            <input type="password" name="password" id="password">
        </p>
        <input type="submit" name="envio" id="envio" value="Enviar Datos">
    </form>
</body>
</html>