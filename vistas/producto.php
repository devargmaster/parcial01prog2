<?php
require_once '../clases/Seccion.php';
require_once '../clases/Producto.php';
$id = $_GET['id'];
$obj = new Producto();
$seccion = new Seccion();
$producto = $obj->producto_x_id($id);
echo "<pre>";
print_r($producto);
echo "</pre>";
?>
<!DOCTYPE html>
<html lang="es">
<header>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bella Casa</title>
  <link href="../css/styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</header>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Bella Casa</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?PHP
      // armo los links de las secciones habilitadas
      for ($i=0; $i < count($seccion->secciones_completas()); $i++) {
        if ($seccion->secciones_completas()[$i]['habilitada'] == 1) {
          echo "<ul class='navbar-nav me-auto mb-2 mb-lg-0'>";
          echo "  <li class='nav-item'><a class='nav-link active' href=../index.php?sec=" . $seccion->secciones_completas()[$i]['sec'] . " >" . $seccion->secciones_completas()[$i]['nombre'] . "</a> </li>";
          echo "</ul>";
        }
      }
      ?>
    </div>
  </div>
</nav>
<main class="container">
  <div class="row">
    <div class="col-12 col-md-4">
      <div class='card mb-3'>
        <img src="<?= "../". $producto->producto_imagen ?>" class='card-img-top' alt='...'>
        <p class="card-text"><?= $producto->producto_descripcion ?></p>
        <div class="card-body">
          <div class="fs-3 mb-3 fw-bold text-center text-danger">
            <?= number_format($producto->producto_precio, 2, ",", ".") ?></div>
          <a href="vistas/producto.php?sec=<?= $producto->producto_nombre ?> &id=<?= $producto->id ?>"
             class="btn btn-danger w-100 fw-bold">VER MÁS</a>
        </div>
      </div>
    </div>
  </div>
</main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<footer>
</footer>
</html>


