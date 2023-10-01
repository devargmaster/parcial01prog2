<link rel="stylesheet" href="css/catalogo.css">
<?php
require_once 'clases/Producto.php';
$sec = $_GET['sec'];
$productos = new Producto();
$catalogo = $productos->todos_los_productos();
//echo "<pre>";
//print_r($catalogo);
//echo "</pre>";
?>

    <?PHP
    foreach ($catalogo as $producto) {?>
      <div class="col-12 col-md-4 mx-auto card_box">
        <div class='card mb-3'>
          <img src="<?=$producto->getProducto_imagen()?>" class='card-img-top' alt='<?=$producto->getProducto_nombre(); ?>'>
          <div class="card-body">
          <h2 class="card-title mb-2"><a href="index.php?sec=producto&id=<?= $producto->getID(); ?>" class="titulo"><?=$producto->getProducto_nombre(); ?></a></h2>
          <p class="card-text mb-2"><?= $producto->descripcion_limite() ?></p>

            <div class="fs-3 mb-3 fw-bold text-center producto_precio_estilo">
              <?= number_format($producto->getProducto_precio(), 2, ",", ".") ?> ARS</div>
            <a href="index.php?sec=producto&id=<?= $producto->getID() ?>"
               class="btn boton_estilo  w-100 fw-bold mt-2">VER MÁS</a>
          </div>
        </div>
      </div>

    <?PHP } ?>
