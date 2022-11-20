<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form name="formupersona" action="?method=crearpersona" method="post">
        <h2>Añadir persona:</h2>
        <label>Nombre: </label>
        <input type="text" id="nombre" name="nombre">
        <label>Apellidos: </label>
        <input type="text" id="apellidos" name="apellidos">
        <label>Dirección: </label>
        <input type="text" id="direccion" name="direccion">
        <label>Teléfono: </label>
        <input type="text" id="telefono" name="telefono">
        <input type="submit" name="envio" id="envio" value="Enviar Datos">
    </form>
</body>
</html>