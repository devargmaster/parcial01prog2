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
            <a href="index.php?sec=editar_marca&ruta=adm&id=<?= $marca->getId(); ?>" class="btn btn-primary btn-sm">Editar</a>
            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-marca-id="<?= $marca->getId(); ?>">Eliminar</button>
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

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar esta marca?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
            </div>
        </div>
    </div>
</div>


<script>
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var marcaId = button.getAttribute('data-marca-id');

        var confirmDeleteButton = confirmDeleteModal.querySelector('#confirmDeleteButton');
        confirmDeleteButton.onclick = function() {
            window.location.href = 'accion/acc_borra_marca.php?id=' + marcaId;
        };
    });
</script>
