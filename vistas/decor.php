<?php
require_once 'clases/Decor.php';

$decor = new Decor();
echo "<pre>";
print_r($decor->todos_los_productos());
echo "</pre>";
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bella Casa</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <link href="css/styles.css" rel="stylesheet">
</head>

<body>
<main class="container">


  <div class="row">
    <?PHP
    // armo los links de las secciones habilitadas
    for ($i = 0; $i < count($decor->todos_los_productos()); $i++) { ?>
      <div class="col-12 col-md-4">
        <div class='card mb-3'>
          <?PHP echo "<img src=" . $decor->todos_los_productos()[$i]['producto_imagen'] . " class='card-img-top' alt='...'>";
          echo "<a href=vistas/producto.php?sec=" . $decor->todos_los_productos()[$i]['producto_nombre'] . " >" . $decor->todos_los_productos()[$i]['producto_nombre'] . "</a> "; ?>
          <p class="card-text"><?= $decor->todos_los_productos()[$i]['producto_descripcion'] ?></p>
          <div class="card-body">
            <div class="fs-3 mb-3 fw-bold text-center text-danger">
              $<?= number_format($decor->todos_los_productos()[$i]['producto_precio'], 2, ",", ".") ?></div>
            <a
              href="vistas/producto.php?sec=<?= $decor->todos_los_productos()[$i]['producto_nombre'] ?>&id=<?= $decor->todos_los_productos()[$i]['id'] ?>"
              class="btn btn-danger w-100 fw-bold">VER MÁS</a>
          </div>
        </div>
      </div>

    <?PHP } ?>
  </div>
</main>
</body>
<footer>
</footer>
</html>
