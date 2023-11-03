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
          <button class="btn btn-info btn-sm" onclick="new bootstrap.Modal(document.getElementById('modalVerProducto')).show();" data-id="<?= $producto->getID(); ?>" data-nombre="<?= $producto->getProducto_nombre(); ?>" data-precio="<?= $producto->getProducto_precio(); ?>" data-descripcion="<?= htmlspecialchars($producto->getProducto_descripcion()); ?>" data-imagen="<?= $producto->getProducto_imagen(); ?>">Ver</button>

          <!--          <a href="index.php?sec=producto&id=--><?php //= $producto->getID() ?><!--" class="btn btn-info btn-sm">Ver</a>-->
          <a href="editar.php?id=<?= $producto->getID() ?>" class="btn btn-primary btn-sm">Editar</a>
          <a href="borrar.php?id=<?= $producto->getID() ?>" class="btn btn-danger btn-sm">Eliminar</a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>



<!-- Modal para ver detalles del producto -->
<div class="modal fade" id="modalVerProducto" tabindex="-1" role="dialog" aria-labelledby="modalVerProductoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- ... [Resto del código del modal] ... -->
    </div>
  </div>
</div>

<script>
  document.getElementById('modalVerProducto').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute('data-id');
    var nombre = button.getAttribute('data-nombre');
    var precio = button.getAttribute('data-precio');
    var descripcion = button.getAttribute('data-descripcion');
    var imagen = button.getAttribute('data-imagen');

    var modal = this;
    modal.querySelector('.modal-title').textContent = nombre;
    modal.querySelector('.modal-body #producto_imagen').src = imagen;
    modal.querySelector('.modal-body #producto_precio').textContent = precio;
    modal.querySelector('.modal-body #producto_descripcion').textContent = descripcion;
  });

</script>
