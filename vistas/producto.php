<?php
require_once 'clases/Producto.php';
$id = $_GET['id'];

try {
    $producto = (new Producto())->producto_x_id($id);
} catch (Exception $e) {
  echo "<div class='alert alert-danger' role='alert'>
    No se encontraron productos para el id: $id
  </div>";
}

//  echo "<pre>";
//  print_r($producto);
//  echo "</pre>";
?>
<div class="container mt-4 mb-4">
  <div class="row">

    <div class="col-md-6">
      <img class="producto_imagen_estilo" src="../img/productos/<?= $producto->getProducto_imagen() ?>"
           alt="<?= $producto->getProducto_nombre() ?>">
    </div>

    <div class="col-md-6">
      <div class="detalle_producto">
        <h2 class="producto_titulo_estilo"><?= $producto->getProducto_nombre() ?></h2>
        <p class="producto_descripcion_estilo"><?= $producto->getProducto_descripcion() ?></p>
        <p class="producto_precio_estilo_formulario"><?= number_format($producto->getProducto_precio(), 2, ",", ".") ?>
          ARS</p>
        <div class="informacion_adicional_estilo">
          <img src="img/detalle.png" alt="informacion adicional"> Informacion adicional

          <?php
          $infoAdicional = $producto->getProductoInfoAdicional();

          if ($infoAdicional !== null) {
            echo (!empty($infoAdicional->getMedidas()) ? "<p class='producto_descripcion_estilo'>Medidas:" . $infoAdicional->getMedidas() . "</p>" : "");
            echo (!empty($infoAdicional->getMaterial()) ? "<p class='producto_descripcion_estilo'>Material:" . $infoAdicional->getMaterial() . "</p>" : "");
            echo (!empty($infoAdicional->getPeso()) ? "<p class='producto_descripcion_estilo'>Peso:" . $infoAdicional->getPeso() . "</p>" : "");
            echo (!empty($infoAdicional->getOrigen()) ? "<p class='producto_descripcion_estilo'>Origen:" . $infoAdicional->getOrigen() . "</p>" : "");

          } else {
            echo "<p class='producto_descripcion_estilo'>Información no disponible</p>";
          }
          ?>
        </div>


        <button class="btn btn-primary carrito_boton_estilo">Agregar al Carrito</button>
      </div>
    </div>
  </div>
</div>


