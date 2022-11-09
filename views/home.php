<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Inventario de Productos</h1>
    <table>
    <?php foreach ($products as $item) : ?>
        <tr>
            <!-- " lo puesto antes $item[0] es igual que poner echo -->
            <td>Identificador <?= $item[0]?></td>
            <td>Descripcion <?= $item[1] ?></td>
            <td><a href="?method=show&&id= <?= $item[0]?>">Ver Detalles</a></td>
        </tr>
    <?php endforeach; ?> <!-- en lugar de poner {} poner : y terminar en endforeach queda mas limpio cuando se pone php dentro de html-->
</table>
</body>
</html>