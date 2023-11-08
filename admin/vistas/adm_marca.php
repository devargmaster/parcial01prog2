<?php
?>

<div class="container mt-5">
  <h2>Administrar Marcas</h2>
  <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalMarca">Nueva Marca</button>

  <!-- Tabla para mostrar marcas -->
  <table class="table">
    <thead>
    <tr>
      <th>ID</th>
      <th>Título</th>
      <th>Descripción</th>
      <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $marcas = (new Marca())->todas_las_marcas();
    foreach($marcas as $marca): ?>
      <tr>
        <td><?php echo htmlspecialchars($marca->getId()); ?></td>
        <td><?php echo htmlspecialchars($marca->getMarcaTitulo()); ?></td>
        <td><?php echo htmlspecialchars($marca->getMarcaDescripcion()); ?></td>
        <td>
          <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalMarca" onclick="editarMarca(<?php echo htmlspecialchars($marca->getId()); ?>)">Editar</button>
          <button class="btn btn-sm btn-danger" onclick="eliminarMarca(<?php echo htmlspecialchars($marca->getId()); ?>)">Eliminar</button>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Modal para añadir/editar marcas -->
<div class="modal fade" id="modalMarca" tabindex="-1" aria-labelledby="modalMarcaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalMarcaLabel">Nueva Marca</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formMarca" action="index.php?sec=alta_marca&ruta=acc" method="post">
          <input type="hidden" id="marcaId" name="marca_id">
          <div class="mb-3">
            <label for="tituloMarca" class="form-label">Título</label>
            <input type="text" class="form-control" id="tituloMarca" name="marca_titulo" required>
          </div>
          <div class="mb-3">
            <label for="descripcionMarca" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcionMarca" name="marca_descripcion" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>function editarMarca(id) {
// Aquí iría el código para cargar los datos de la marca en el modal.
// Esto normalmente implicaría una llamada AJAX para obtener los datos y luego llenar el formulario.
  }

  function eliminarMarca(id) {
// Aquí iría el código para enviar una solicitud de eliminación.
// Esto podría ser una solicitud AJAX o una redirección a un script PHP que maneje la eliminación.
  }
</script>

