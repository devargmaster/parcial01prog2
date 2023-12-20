<?php
require_once 'clases/Producto.php';
$productos_destacados = new Producto();
$catalogo = $productos_destacados->productos_destacados();
//echo "<pre>";
//print_r($catalogo);
//echo "</pre>";
//?>
<section class="destacados">
  <div class="container mt-5 mb-5">
    <h2 class="text-center">Productos Destacados</h2>
    <div class="row">
      <?PHP
      $oferta = new Oferta();
      foreach ($catalogo as $producto) {
          $ofertaProducto = $oferta->ofertaxId($producto->getID());?>
        <div class="col-md-4">
          <div class="card">
              <div class="card-img-container">
                  <img src="img/productos/<?= $producto->getProducto_imagen() ?>" class='card-img-top'
                       alt='<?= $producto->getProducto_nombre(); ?>'>
                  <?php if ($producto->getProductoOferta()) {  ?>
                      <span class="ofertaestilo"><?= $ofertaProducto ? $ofertaProducto->getOfertaTitulo() : 'Oferta' ?></span>
                  <?php } ?>
              </div>
            <div class="card-body">
              <h2 class="card-title mb-2"><a href="index.php?sec=producto&id=<?= $producto->getID(); ?>"
                                             class="producto_titulo_estilo"><?= $producto->getProducto_nombre(); ?></a>
              </h2>
                <span class="badge bg-primary badge_categoria"><?php echo $producto->getProductoCategoria(); ?></span>
                <?php foreach ($producto->getProductoSubcategoria() as $subcategoria): ?>
                    <span class="badge bg-secondary badge_subcategoria"><?= $subcategoria->getNombre(); ?></span>
                <?php endforeach; ?>
              <div class="fs-3 mb-3 fw-bold text-center producto_precio_estilo_formulario">
                <?= number_format($producto->getProducto_precio(), 2, ",", ".") ?> ARS
              </div>
              <a href="index.php?sec=producto&id=<?= $producto->getID() ?>"
                 class="btn botones_general  mt-2">VER MÁS</a>
            </div>
          </div>
        </div>
      <?PHP } ?>
    </div>
  </div>
</section>
