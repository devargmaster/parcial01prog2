<?php
require_once 'clases/Producto.php';
if (isset($_GET['sec']) && isset($_GET['subsec'])) {
  $sec = $_GET['sec'];
  $subsec = $_GET['subsec'];
  $decor = new Producto();
  $catalogo = $decor->productos_x_subcategoria("$subsec");
} else {
  $sec = $_GET['sec'];
  $decor = new Producto();
  $catalogo = $decor->obtenerPorCategoria("$sec");
}
echo "<pre>";
print_r($decor->obtenerPorCategoria("$sec"));
echo "</pre>";
?>


<?PHP
foreach ($catalogo as $producto) { ?>
  <div class="col-12 col-md-4">
    <div class='card mb-3'>
      <img src="<?= $producto->getProducto_imagen() ?>" class='card-img-top'
           alt='<?= $producto->getProducto_imagen() ?>'>
      <div class="card-body">
        <h2 class="card-title mb-2"><a href="index.php?sec=producto&id=<?= $producto->getID(); ?>"
                                       class="producto_titulo_estilo"><?= $producto->getProducto_nombre(); ?></a></h2>
        <p class="card-text mb-2"><?= $producto->descripcion_limite() ?></p>
        <div class="fs-3 mb-3 fw-bold text-center ">
          <?= number_format($producto->getProducto_precio(), 2, ",", ".") ?> ARS
        </div>
        <a href="vistas/producto.php?sec=producto&id=<?= $producto->getID() ?>"
           class="btn carrito_boton_estilo w-100 fw-bold mt-2">VER MÁS</a>
      </div>
    </div>
  </div>

<?PHP } ?>

