<?php
$categorias = (new Categoria())->categorias_completas();
$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';
echo (new Alerta())->get_alertas();
if (strpos($currentPath, '/vistas/') !== false) {
    $basePath = '../';
}
?>

<div class="container mt-5">

  <h2>Administrar Categorías</h2>
  <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalCategoria">Nueva Categoría</button>
  <table class="table">
    <thead>
    <tr>
      <th class="col-auto d-none d-md-table-cell">ID</th>
      <th>Nombre</th>
      <th class="col-auto d-none d-md-table-cell">Descripción</th>
      <th>Habilitada</th>
      <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($categorias as $categoria): ?>
      <tr>
        <td class="col-auto d-none d-md-table-cell"><?=$categoria['id']; ?></td>
        <td><?=$categoria['nombre']; ?></td>
        <td class="col-auto d-none d-md-table-cell"><?=$categoria['descripcion']; ?></td>
        <td><?=$categoria['habilitada'] ? 'Sí' : 'No'; ?></td>
        <td>
            <a href="index.php?sec=editar_categoria&ruta=adm&id=<?= $categoria['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-categoria-id="<?= $categoria['id']; ?>">Eliminar</button>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCategoriaLabel">Nueva Categoría</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formCategoria" action="index.php?sec=alta_categoria&ruta=acc" method="post">
          <input type="hidden" id="categoriaId" name="categoria_id">
          <div class="mb-3">
            <label for="nombreCategoria" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreCategoria" name="nombre" required>
          </div>
            <div class="mb-3">
                <label for="es_menu">Es menú:</label>
                <select id="es_menu" name="es_menu">
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                </select>
            </div>
          <div class="mb-3">
            <label for="descripcionCategoria" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcionCategoria" name="descripcion" rows="3"></textarea>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="habilitadaCategoria" name="habilitada">
            <label class="form-check-label" for="habilitadaCategoria">Habilitada</label>
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
                ¿Estás seguro de que deseas eliminar esta categoria?
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
        var categoriaId = button.getAttribute('data-categoria-id');

        var confirmDeleteButton = confirmDeleteModal.querySelector('#confirmDeleteButton');
        confirmDeleteButton.onclick = function() {
            window.location.href = 'accion/acc_borra_categoria.php?id=' + categoriaId;
        };
    });
</script>