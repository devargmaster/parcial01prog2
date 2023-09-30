<?php
require_once 'clases/Producto.php';
$sec = $_GET['sec'];
$bazar = new Producto();
echo "<pre>";
print_r($bazar->productos_x_categoria("$sec"));
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

  <link href="/css/styles.css" rel="stylesheet">
</head>

<body>
<main class="container">
  <div class="row">
    <?PHP
    // armo los links de las secciones habilitadas
    for ($i = 0; $i < count($bazar->productos_x_categoria("$sec")); $i++) { ?>
      <div class="col-12 col-md-4">
        <div class='card mb-3'>
          <img src="<?=$bazar->productos_x_categoria("$sec")[$i]->producto_imagen?>" class='card-img-top' alt='...'>
          <a href=vistas/producto.php?sec="<?=$bazar->productos_x_categoria("$sec")[$i]->producto_nombre?>"><?=$bazar->productos_x_categoria("$sec")[$i]->producto_nombre?></a>
          <p class="card-text"><?= $bazar->productos_x_categoria("$sec")[$i]->producto_descripcion ?></p>
          <div class="card-body">
            <div class="fs-3 mb-3 fw-bold text-center text-danger">
              <?= number_format($bazar->productos_x_categoria("$sec")[$i]->producto_precio, 2, ",", ".") ?></div>
            <a href="vistas/producto.php?sec=<?= $bazar->productos_x_categoria("$sec")[$i]->producto_nombre ?> &id=<?= $bazar->productos_x_categoria("$sec")[$i]->id ?>"
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
