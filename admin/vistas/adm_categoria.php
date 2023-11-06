<?php
// Primero, obtenemos las categorías completas.
$categorias = (new Categoria())->categorias_completas();
?>

<div class="container mt-5">
  <h2>Administrar Categorías</h2>
  <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalCategoria">Nueva Categoría</button>

  <!-- Tabla para mostrar categorías -->
  <table class="table">
    <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Habilitada</th>
      <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($categorias as $categoria): ?>
      <tr>
        <td><?php echo htmlspecialchars($categoria->getID()); ?></td>
        <td><?php echo htmlspecialchars($categoria->getNombre()); ?></td>
        <td><?php echo htmlspecialchars($categoria->getDescripcion()); ?></td>
        <td><?php echo $categoria->getHabilitada() ? 'Sí' : 'No'; ?></td>
        <td>
          <!-- Botón para editar una categoría -->
          <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalCategoria" onclick="editarCategoria(<?php echo htmlspecialchars($categoria->getID()); ?>)">Editar</button>
          <!-- Botón para eliminar una categoría -->
          <button class="btn btn-sm btn-danger" onclick="eliminarCategoria(<?php echo htmlspecialchars($categoria->getID()); ?>)">Eliminar</button>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<!-- Modal para añadir/editar categorías -->
<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCategoriaLabel">Nueva Categoría</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formCategoria">
          <input type="hidden" id="categoriaId" name="categoria_id">
          <div class="mb-3">
            <label for="nombreCategoria" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreCategoria" name="nombre" required>
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
