<!doctype html>
<html lang="es">

<head>
  <?php require "../app/views/parts/head.php" ?>
</head>

<body>

  <!-- !! COMPLETAR !! -->

  <?php require "../app/views/parts/header.php" ?>

  <main role="main" class="container">
    <div class="starter-template">
      <h1>Lista de jugadores</h1>
      <p>
      <a href="" class="btn btn-primary">Nuevo</a>
      <a href="" class="btn btn-primary">titulares</a>        
      </p>
      <table class="table table-striped table-hover">
        <tr>
          <th>Nombre</th>
          <th>Puesto</th>
          <th>F. nacimiento</th>
          <th></th>
        </tr>

        <?php foreach ($jugadores as $jugador) { ?>
          <tr>
            <td><?php echo $jugador->nombre ?></td>
            <td><?php echo $jugador->puesto ?></td>
            <td><?php echo $jugador->nacimiento ?></td>
            <td>
              <a href= "/jugador/show/<?php echo $jugador->id ?>" class="btn btn-primary" >Editar</a>
              <a href= "/jugador/show/<?php echo $jugador->id ?>" class="btn btn-primary" >Titular</a>
            </td>
          </tr>
        <?php } ?>
      </table>

    </div>

  </main><!-- /.container -->
  <?php require "../app/views/parts/footer.php" ?>


</body>
<?php require "../app/views/parts/scripts.php" ?>

</html>