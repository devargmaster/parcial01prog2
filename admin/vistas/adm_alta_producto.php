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
      <label for="productoDescripcion">Descripción del Producto</label>
      <textarea class="form-control" id="productoDescripcion" name="producto_descripcion" rows="3"></textarea>
    </div>
<hr>
    <button type="button" id="toggleInfoAdicional" class="btn btn-secondary">Agregar Información Adicional</button>

    <div id="informacionAdicionalContainer" style="display:none;">
      <h4>Información Adicional</h4>
      <div class="form-group">
        <label for="medidas">Medidas</label>
        <input type="text" class="form-control" id="medidas" name="medidas" placeholder="Ingrese las medidas">
      </div>
      <div class="form-group">
        <label for="peso">Peso</label>
        <input type="text" class="form-control" id="peso" name="peso" placeholder="Ingrese el peso">
      </div>
      <div class="form-group">
        <label for="material">Material</label>
        <input type="text" class="form-control" id="material" name="material" placeholder="Ingrese el material">
      </div>
      <div class="form-group">
        <label for="origen">Origen</label>
        <input type="text" class="form-control" id="origen" name="origen" placeholder="Ingrese el origen">
      </div>
    </div>
    <hr>
    <div class="form-group">
      <label for="productoPrecio">Precio del Producto</label>
      <input type="number" step="0.01" class="form-control" id="productoPrecio" name="producto_precio" required>
    </div>

    <div class="form-group">
      <label for="productoStock">Stock del Producto</label>
      <input type="number" class="form-control" id="productoStock" name="producto_stock" required>
    </div>
    <div class="form-group">
      <label for="marcaId">Marca</label>
      <select class="form-select" id="marcaId" name="marca_id">
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
      <select class="form-select" id="productoCategoria" name="producto_categoria">
          <option value="">Seleccione una categoría</option>
        <?php foreach ($categorias as $categoria): ?>
          <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
      <div class="form-group">
          <label for="productoSubcategoria">Subcategoría del Producto</label>
          <select class="form-select" id="productoSubcategoria" name="producto_subcategoria">
              <option value="">Seleccione una subcategoría</option>
              <?php foreach ($subcategorias as $subcategoria): ?>
                  <option value="<?= $subcategoria['id'] ?>"><?= $subcategoria['nombre'] ?></option>
              <?php endforeach; ?>
          </select>
      </div>
    <div class="form-group">
      <label for="productoEstado">Estado del Producto</label>
      <select class="form-select" id="productoEstado" name="producto_estado">
        <option value="1">Activo</option>
        <option value="0">No Activo</option>
      </select>
    </div>

    <div class="form-group">
      <label for="productoNuevo">Producto Nuevo</label>
      <select class="form-select" id="productoNuevo" name="producto_nuevo">
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
      <select class="form-select" id="productoDestacado" name="producto_destacado">
        <option value="1">Sí</option>
        <option value="0">No</option>
      </select>
    </div> <br>
    <button type="submit" class="btn btn-primary">Agregar Producto</button>
  </form>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('informacionAdicionalContainer');
    const toggleButton = document.getElementById('toggleInfoAdicional');

    toggleButton.addEventListener('click', function() {
      // Esto alterna la visibilidad del contenedor
      if (container.style.display === 'none') {
        container.style.display = 'block';
        toggleButton.textContent = 'Ocultar Información Adicional';
      } else {
        container.style.display = 'none';
        toggleButton.textContent = 'Agregar Información Adicional';
      }
    });
  });
</script>
