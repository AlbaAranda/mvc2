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

    <h1>Alta de jugadores</h1>
    
    <form method="post" action="/jugador/store" enctype="">
      <label>Nombre Completo:</label>
      <input type="text" name="nombre">
      <br><br>
      <label>Puesto: </label>
      <input type="text" name="puesto">
      <br><br>
      <label>Fecha de nacimiento:</label>
      <input type="text" name="fechaNacimiento">
      <br><br>
      <button type="submit" class="btn btn-default">Enviar</button>
    </form>    
  </div>

  </main><!-- /.container -->
  <?php require "../app/views/parts/footer.php" ?>

</body>
<?php require "../app/views/parts/scripts.php" ?>

</html>