<?php
$listaDeProductos = (new Producto())->todos_los_productos();
$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';


if (strpos($currentPath, '/vistas/') !== false) {
  $basePath = '../';
}
?>
<div class="container mt-5">

  <div class="mb-4">
    <a href="index.php?sec=alta_producto&ruta=vistas" class="btn btn-primary" data-toggle="modal" data-target="#modalProducto">Nuevo Producto</a>
  </div>

  <table class="table">
    <thead>
    <tr>
      <th>ID</th>
      <th>Imagen</th>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($listaDeProductos as $producto) { ?>
      <tr>
        <td><?= $producto->getID(); ?></td>
        <td>
          <img src="../img/productos/<?= $producto->getProducto_imagen() ?>" alt="<?= $producto->getProducto_nombre(); ?>" style="width: 50px; height: auto;">
        </td>
        <td><?= $producto->getProducto_nombre(); ?></td>
        <td><?= number_format($producto->getProducto_precio(), 2, ",", ".") ?> ARS</td>
        <td>
          <a href="<?= $basePath ?>index.php?sec=editar_producto&ruta=vistas&id=<?= $producto->getID() ?>" class="btn btn-primary btn-sm">Editar</a>
          <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-producto-id="<?= $producto->getID(); ?>">Eliminar</button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>


<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</p>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas eliminar este producto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
      </div>
    </div>
  </div>
</div>


<script>
  document.getElementById('modalVerProducto').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
      var id = button.getAttribute('data-bs-producto-id');
      var nombre = button.getAttribute('data-bs-producto-nombre');
      var precio = button.getAttribute('data-bs-producto-precio');
      var descripcion = button.getAttribute('data-bs-producto-descripcion');
      var categoria = button.getAttribute('data-bs-producto-categoria');
      var subcategoria = button.getAttribute('data-bs-producto-subcategoria');
      var marca = button.getAttribute('data-bs-producto-marca');
      var stock = button.getAttribute('data-bs-producto-stock');
      var estado = button.getAttribute('data-bs-producto-estado');
      var destacado = button.getAttribute('data-bs-producto-destacado');
      var imagenSrc = button.getAttribute('data-bs-producto-imagen-src');

    var modal = this;
      modal.querySelector('#productoId').textContent = id;
      modal.querySelector('#productoNombre').textContent = nombre;
      modal.querySelector('#productoPrecio').textContent = precio;
      modal.querySelector('#productoDescripcion').textContent = descripcion;
      modal.querySelector('#productoCategoria').textContent = categoria;
      modal.querySelector('#productoSubcategoria').textContent = subcategoria;
      modal.querySelector('#productoMarca').textContent = marca;
      modal.querySelector('#productoStock').textContent = stock;
      modal.querySelector('#productoEstado').textContent = estado === '1' ? 'Activo' : 'Inactivo';
      modal.querySelector('#productoDestacado').textContent = destacado === '1' ? 'Sí' : 'No';
      modal.querySelector('#productoImagen').src = imagenSrc;
  });

  var confirmDeleteModal = document.getElementById('confirmDeleteModal');
  confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var productoId = button.getAttribute('data-producto-id');

    var confirmDeleteButton = confirmDeleteModal.querySelector('#confirmDeleteButton');
    confirmDeleteButton.onclick = function() {
      window.location.href = '/admin/accion/acc_borra_producto.php?id=' + productoId;
    };
  });
</script>
