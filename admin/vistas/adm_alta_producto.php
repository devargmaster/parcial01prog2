<?php
$marcas = (new Marca())->todas_las_marcas();
$categorias = (new Categoria())->categorias_completas();
$subcategorias = (new Subcategoria())->subcategorias_completas();
?>
<div class="container mt-5">
  <h2>Agregar Nuevo Producto</h2>
  <form id="addProductForm" action="index.php?sec=alta_producto&ruta=acc" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="productoNombre">Nombre del Producto</label>
      <input type="text" class="form-control" id="productoNombre" name="producto_nombre" required>
    </div>
    <div class="form-group">
      <label for="productoPrecio">Precio del Producto</label>
      <input type="number" step="0.01" class="form-control" id="productoPrecio" name="producto_precio" required>
    </div>
    <div class="form-group">
      <label for="productoDescripcion">Descripción del Producto</label>
      <textarea class="form-control" id="productoDescripcion" name="producto_descripcion" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="productoStock">Stock del Producto</label>
      <input type="number" class="form-control" id="productoStock" name="producto_stock" required>
    </div>
    <div class="form-group">
      <label for="marcaId">Marca</label>
      <select class="form-control" id="marcaId" name="marca_id">
        <?php foreach ($marcas as $marca): ?>
          <option value="<?= $marca->getId() ?>"><?= $marca->getMarcaTitulo() ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-6 mb-3">
      <label for="imagen" class="form-label">Imagen del producto</label>
      <input class="form-control" type="file" id="imagen" name="imagen" required>
    </div>
    <div class="form-group">
      <label for="productoCategoria">Categoría del Producto</label>
      <select class="form-control" id="productoCategoria" name="producto_categoria">
        <?php foreach ($categorias as $categoria): ?>
          <option value="<?= $categoria->getId() ?>"><?= $categoria->getNombre() ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="productoSubcategoria">Subcategoría del Producto</label>
      <select class="form-control" id="productoSubcategoria" name="producto_subcategoria">
        <?php foreach ($subcategorias as $subcategoria): ?>
          <option value="<?= $subcategoria->getId() ?>"><?= $subcategoria->getNombre() ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="productoEstado">Estado del Producto</label>
      <select class="form-control" id="productoEstado" name="producto_estado">
        <option value="1">Activo</option>
        <option value="0">No Activo</option>
      </select>
    </div>
    <div class="form-group">
      <label for="productoOfertaId">ID de Oferta</label>
      <input type="number" class="form-control" id="productoOfertaId" name="producto_oferta_id">
    </div>
    <div class="form-group">
      <label for="productoNuevo">Producto Nuevo</label>
      <select class="form-control" id="productoNuevo" name="producto_nuevo">
        <option value="1">Sí</option>
        <option value="0">No</option>
      </select>
    </div>
    <div class="form-group">
      <label for="productoFecha">Fecha de Alta del Producto</label>
      <input type="date" class="form-control" id="productoFecha" name="producto_fecha">
    </div>
    <div class="form-group">
      <label for="productoDestacado">Producto Destacado</label>
      <select class="form-control" id="productoDestacado" name="producto_destacado">
        <option value="1">Sí</option>
        <option value="0">No</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Agregar Producto</button>
  </form>
</div>
