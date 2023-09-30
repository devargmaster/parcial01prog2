<?php
require_once 'clases/Producto.php';
$sec = $_GET['sec'];
$iluminacion = new Producto();
$catalogo = $iluminacion->productos_x_categoria("$sec");
//echo "<pre>";
//print_r($iluminacion->productos_x_categoria("$sec"));
//echo "</pre>";
?>


    <?PHP
    foreach ($catalogo as $producto) {?>
      <div class="col-12 col-md-4">
        <div class='card mb-3'>
          <img src="<?=$producto->getProducto_imagen()?>" class='card-img-top' alt='...'>
          <a href="index.php?sec=<?="producto"?>&id=<?= $producto->getID(); ?>"><?=$producto->getProducto_nombre(); ?></a>
          <p class="card-text"><?= $producto->descripcion_limite() ?></p>
          <div class="card-body">
            <div class="fs-3 mb-3 fw-bold text-center text-danger">
              <?= number_format($producto->getProducto_precio(), 2, ",", ".") ?></div>
            <a href="vistas/producto.php?sec=<?= $sec?> &id=<?= $producto->getID() ?>"
               class="btn btn-danger w-100 fw-bold">VER MÁS</a>
          </div>
        </div>
      </div>

    <?PHP } ?>
