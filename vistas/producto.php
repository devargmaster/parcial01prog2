<?php
require_once 'clases/Producto.php';
$id = $_GET['id'];
$obj = new Producto();
$producto = $obj->producto_x_id($id);
//echo "<pre>";
//print_r($producto);
//echo "</pre>";
?>

    <div class="col-12 col-md-4">
      <div class='card mb-3'>
        <img src="<?= $producto->getProducto_imagen() ?>" class='card-img-top' alt='...'>
        <p class="card-text"><?= $producto->getProducto_descripcion() ?></p>
        <div class="card-body">
          <div class="fs-3 mb-3 fw-bold text-center text-danger">
            <?= number_format($producto->getProducto_precio(), 2, ",", ".") ?></div>

        </div>
      </div>
    </div>


