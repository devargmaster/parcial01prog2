<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Productos</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Gestión de Productos</h2>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.7.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></
