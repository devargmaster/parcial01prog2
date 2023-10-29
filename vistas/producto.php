<?php
require_once 'clases/Producto.php';
$id = $_GET['id'];
$obj = new Producto();
$producto = $obj->producto_x_id($id);
if (empty($producto)) {
  echo "<div class='alert alert-danger' role='alert'>
    No se encontraron productos para el id: $id
  </div>";
}
  echo "<pre>";
  print_r($producto);
  echo "</pre>";
?>
<div class="container mt-4 mb-4">
  <div class="row">

    <div class="col-md-6">
      <img class="producto_imagen_estilo" src="<?= $producto->getProducto_imagen() ?>"
           alt="<?= $producto->getProducto_nombre() ?>">
    </div>

    <div class="col-md-6">
      <div class="detalle_producto">
        <h2 class="producto_titulo_estilo"><?= $producto->getProducto_nombre() ?></h2>
        <p class="producto_descripcion_estilo"><?= $producto->getProducto_descripcion() ?></p>
        <p class="producto_precio_estilo_formulario"><?= number_format($producto->getProducto_precio(), 2, ",", ".") ?>
          ARS</p>
        <div class="informacion_adicional_estilo">

          <h5><img src="img/detalle.png" alt="informacion adicional"> Informacion adicional</h5>
          <?php
          $infoAdicional = $producto->getProductoInfoAdicional();
          if(is_array($infoAdicional) && !empty($infoAdicional)){
            foreach($infoAdicional as $key => $value){
              echo "<strong>{$key}:</strong> {$value}<br>";
            }
          } else {
            echo "No hay información adicional disponible.";
          }
          ?>
        </div>
        <button class="btn btn-primary carrito_boton_estilo">Agregar al Carrito</button>
      </div>
    </div>
  </div>
</div>


