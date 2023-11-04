<?php
$listaDeProductos = (new Producto())->todos_los_productos();
?>
<div class="container mt-5">

  <div class="mb-4">
    <button class="btn btn-primary" data-toggle="modal" data-target="#modalProducto">Nuevo Producto</button>
  </div>

  <!-- Tabla de productos -->
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
          <img src="../<?= $producto->getProducto_imagen() ?>" alt="<?= $producto->getProducto_nombre(); ?>" style="width: 50px; height: auto;">
        </td>
        <td><?= $producto->getProducto_nombre(); ?></td>
        <td><?= number_format($producto->getProducto_precio(), 2, ",", ".") ?> ARS</td>
        <td>
          <button class="btn btn-info btn-sm btn-ver" data-bs-toggle="modal" data-bs-producto-id="<?= $producto->getID(); ?>" data-bs-target="#modalVerProducto" ...>Ver</button>

          <!--          <a href="index.php?sec=producto&id=--><?php //= $producto->getID() ?><!--" class="btn btn-info btn-sm">Ver</a>-->
          <a href="editar.php?id=<?= $producto->getID() ?>" class="btn btn-primary btn-sm">Editar</a>
          <a href="borrar.php?id=<?= $producto->getID() ?>" class="btn btn-danger btn-sm">Eliminar</a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>



<div class="modal fade" id="modalVerProducto" tabindex="-1" aria-labelledby="modalVerProductoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="modalVerProductoLabel">Detalles del Producto</p>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>ID del Producto: <span id="productoId"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
    var imagen = button.getAttribute('data-bs-producto-imagen');

    var modal = this;
    modal.querySelector('.modal-title').textContent = nombre;
    modal.querySelector('.modal-body #productoId').textContent = id; // Asegúrate de que este ID exista en el HTML de la modal
    // modal.querySelector('.modal-body #producto_imagen').src = imagen; // Comenta esta línea si no tienes un elemento img para la imagen en tu modal
    modal.querySelector('.modal-body #producto_precio').textContent = precio;
    modal.querySelector('.modal-body #producto_descripcion').textContent = descripcion;
  });


</script>
