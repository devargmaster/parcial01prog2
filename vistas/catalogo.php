<?php

if (isset($_GET['sec'])) {
  $sec = $_GET['sec'];
  $catalogo = ( new Producto())->todos_los_productos();
} elseif (isset($_GET['producto'])) {
  $busqueda = $_GET['producto'];
  $catalogo = ( new Producto())->productos_x_busqueda("$busqueda");
  if (empty($catalogo)) {
    echo "<div class='alert alert-danger' role='alert'>
    No se encontraron productos para la busqueda: $busqueda
  </div>";
  }
} else {
  $sec = $_GET['sec'];
  $catalogo = ( new Producto())->getProducto_categoria("$sec");
  if (empty($catalogo)) {
    echo "<div class='alert alert-danger' role='alert'>
    No se encontraron productos para la busqueda: $sec
  </div>";
  }
}

//echo "<pre>";
//print_r($catalogo);
//echo "</pre>";
?>

<?PHP
foreach ($catalogo as $producto) { ?>
  <div class="col-12 col-md-4 ">
    <div class='card mb-3'>
      <img src="img/productos/<?= $producto->getProducto_imagen() ?>" class='card-img-top'
           alt='<?= $producto->getProducto_nombre(); ?>'>
      <div class="card-body">

        <h2 class="card-title mb-2"><a href="index.php?sec=producto&id=<?= $producto->getID(); ?>"
                                       class="producto_titulo_estilo"><?= $producto->getProducto_nombre(); ?></a></h2>
        <p class="card-text mb-2"><?= $producto->descripcion_limite() ?></p>
        <div class="fs-3 mb-3 fw-bold text-center producto_precio_estilo">
          <?= number_format($producto->getProducto_precio(), 2, ",", ".") ?> ARS
        </div>
        <a href="index.php?sec=producto&id=<?= $producto->getID() ?>"
           class="btn carrito_boton_estilo  w-100 fw-bold mt-2 ">VER MÁS</a>
      </div>
    </div>
  </div>

<?PHP } ?>
