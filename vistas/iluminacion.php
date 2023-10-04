<link rel="stylesheet" href="css/formularios_botones_estilos.css">
<?php
require_once 'clases/Producto.php';
if (isset($_GET['sec']) && isset($_GET['subsec'])) {
  $sec = $_GET['sec'];
  $subsec = $_GET['subsec'];
  $iluminacion = new Producto();
  $catalogo = $iluminacion->productos_x_subcategoria("$subsec");
} else {
  $sec = $_GET['sec'];
  $iluminacion = new Producto();
  $catalogo = $iluminacion->productos_x_categoria("$sec");
}
//echo "<pre>";
//print_r($iluminacion->productos_x_categoria("$sec"));
//echo "</pre>";

    foreach ($catalogo as $producto) {?>
      <div class="col-12 col-md-4">
        <div class='card mb-3'>
          <img src="<?=$producto->getProducto_imagen()?>" class='card-img-top' alt='...'>
          <div class="card-body">
            <h2 class="card-title mb-2"><a href="index.php?sec=producto&id=<?= $producto->getID(); ?>" class="producto_titulo_estilo"><?=$producto->getProducto_nombre(); ?></a></h2>
          <p class="card-text mb-2"><?= $producto->descripcion_limite() ?></p>
            <div class="fs-3 mb-3 fw-bold text-center ">
              <?= number_format($producto->getProducto_precio(), 2, ",", ".") ?> ARS</div>
            <a href="index.php?sec=producto&id=<?= $producto->getID() ?>"
               class="btn carrito_boton_estilo w-100 fw-bold mt-2">VER MÁS</a>
          </div>
        </div>
      </div>

    <?PHP } ?>
