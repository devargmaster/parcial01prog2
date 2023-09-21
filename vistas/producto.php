<?php
require_once '../clases/Producto.php';
$id = $_GET['id'];
$obj = new Producto();
$producto = $obj->producto_x_id($id);
//echo "<pre>";
//print_r($producto);
//echo "</pre>";
?>
<!DOCTYPE html>
<html lang="es">
<header>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bella Casa</title>
  <link href="../css/styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="css/styles.css" rel="stylesheet">
</header>
<body>
<?PHP require_once '../vistas/menunav.php'; ?>
<main class="container">
  <div class="row">
    <div class="col-12 col-md-4">
      <div class='card mb-3'>
        <img src="<?= "../". $producto->getProducto_imagen() ?>" class='card-img-top' alt='...'>
        <p class="card-text"><?= $producto->getProducto_descripcion() ?></p>
        <div class="card-body">
          <div class="fs-3 mb-3 fw-bold text-center text-danger">
            <?= number_format($producto->getProducto_precio(), 2, ",", ".") ?></div>

        </div>
      </div>
    </div>
  </div>
</main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<footer>
</footer>
</html>


