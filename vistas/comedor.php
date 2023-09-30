<?php
require_once 'clases/Producto.php';
$sec = $_GET['sec'];
$comedor = new Producto();
$catalogo = $comedor->productos_x_categoria("$sec");
//echo "<pre>";
//print_r($comedor->productos_x_categoria("$sec"));
//echo "</pre>";

    foreach ($catalogo as $producto) {?>
      <div class="col-12 col-md-4">
        <div class='card mb-3'>
          <img src="<?=$producto->getProducto_imagen()?>" class='card-img-top' alt='...'>
          <a href="vistas/producto.php?sec=<?=$sec?>&id=<?= $producto->getID(); ?>"><?=$producto->getProducto_nombre(); ?></a>
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
