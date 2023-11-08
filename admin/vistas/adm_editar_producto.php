<?php
// Obtiene el ID del producto desde la URL
$productoId = $_GET['id'];


$producto = (new Producto())->producto_x_id($productoId);

// Asegúrate de obtener también las marcas, categorías y subcategorías como en el formulario de alta
$marcas = (new Marca())->todas_las_marcas();
$categorias = (new Categoria())->categorias_completas();
$subcategorias = (new Subcategoria())->subcategorias_completas();
?>

<div class="container mt-5">
  <h2>Editar Producto</h2>
  <form id="editProductForm" action="index.php?sec=editar_producto&ruta=acc" method="post" enctype="multipart/form-data">
    <input type="hidden" name="producto_id" value="<?= $productoId ?>">
    <!-- Los campos del formulario aquí, pre-llenados con la información del producto -->
    <!-- Ejemplo: -->
    <div class="form-group">
      <label for="productoNombre">Nombre del Producto</label>
      <input type="text" class="form-control" id="productoNombre" name="producto_nombre" value="<?= $producto->getProducto_nombre() ?>" required>
    </div>
    <!-- Repite para cada propiedad del producto -->
    <!-- ... -->
    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
  </form>
</div>
