<?php
$subcategorias = (new Subcategoria())->subcategorias_completas_nofiltrada();
//echo "<pre>";
//print_r($subcategorias);
//echo "</pre>";
?>
<div class="container mt-5">
  <h2>Administrar Subcategorías</h2>

  <!-- Botón para añadir nueva subcategoría -->
  <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalSubcategoria">Nueva Subcategoría</button>

  <table class="table">
    <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Categoría</th>
      <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($subcategorias as $subcategoria): ?>
      <tr>
          <td><?php echo $subcategoria['id']; ?></td>
          <td><?php echo $subcategoria['nombre']; ?></td>
          <td><?php echo $subcategoria['descripcion']; ?></td>
          <td><?php echo $subcategoria['categoria_nombre'] ?? 'No Asignado'; ?></td>

        <td>
            <a href="index.php?sec=editar_subcategoria&ruta=adm&id=<?= $subcategoria['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-subcategoria-id="<?= $subcategoria['id']; ?>">Eliminar</button>

        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Me quedo con modales solo para el alta de pequeñas entidades, el resto lo manejo como en clase -->
<?php
$categorias = (new Categoria())->categorias_completas();
?>
<div class="modal fade" id="modalSubcategoria" tabindex="-1" aria-labelledby="modalSubcategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSubcategoriaLabel">Nueva Subcategoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSubcategoria" action="index.php?sec=alta_subcategoria&ruta=acc" method="post">
                    <input type="hidden" id="subcategoriaId" name="subcategoria_id">
                    <div class="mb-3">
                        <label for="nombreSubcategoria" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreSubcategoria" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcionSubcategoria" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcionSubcategoria" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="categoriaSubcategoria" class="form-label">Categoría</label>
                        <select class="form-select" id="categoriaSubcategoria" name="categoria_id" required>
                            <?php foreach($categorias as $categoria): ?>
                                <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">¿Es Menú?</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="es_menu" id="esMenuSi" value="1">
                                <label class="form-check-label" for="esMenuSi">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="es_menu" id="esMenuNo" value="0" checked>
                                <label class="form-check-label" for="esMenuNo">No</label>
                            </div>
                        </div>
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
                ¿Estás seguro de que deseas eliminar esta subcategoria?
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
        var subcategoriaId = button.getAttribute('data-subcategoria-id');

        var confirmDeleteButton = confirmDeleteModal.querySelector('#confirmDeleteButton');
        confirmDeleteButton.onclick = function() {
            window.location.href = '/admin/accion/acc_borra_subcategoria.php?id=' + subcategoriaId;
        };
    });

</script>