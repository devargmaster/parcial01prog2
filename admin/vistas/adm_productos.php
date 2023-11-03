
<div class="container mt-5">

  <div class="mb-4">
    <button class="btn btn-primary" data-toggle="modal" data-target="#modalProducto">Nuevo Producto</button>
  </div>
  <!-- Tabla de productos -->
  <table class="table">
    <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Precio</th>
      <!-- ... otras columnas ... -->
      <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <!-- Aquí se insertarían los productos con PHP -->
    </tbody>
  </table>
</div>

<!-- Modal para agregar/editar producto -->
<div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="modalProductoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalProductoLabel">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario para producto -->
        <form id="formProducto">
          <div class="form-group">
            <label for="producto_nombre">Nombre</label>
            <input type="text" class="form-control" id="producto_nombre" name="producto_nombre" required>
          </div>
          <div class="form-group">
            <label for="producto_precio">Precio</label>
            <input type="number" step="0.01" class="form-control" id="producto_precio" name="producto_precio" required>
          </div>
          <!-- ... otros campos del formulario ... -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" form="formProducto" class="btn btn-primary">Guardar Producto</button>
      </div>
    </div>
  </div>
</div>


