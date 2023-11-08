<?php
$subcategorias = (new Subcategoria())->subcategorias_completas();
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
        <td><?php echo $subcategoria->getID(); ?></td>
        <td><?php echo $subcategoria->getNombre(); ?></td>
        <td><?php echo $subcategoria->getDescripcion(); ?></td>
        <td><?php
          $categoria = $subcategoria->getCategoria();
          echo $categoria ? $categoria->getNombre() : 'No Asignado';
          ?></td>
        <td>
          <!-- Botón para editar una subcategoría -->
          <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalSubcategoria" onclick="editarSubcategoria(<?php echo htmlspecialchars($subcategoria->getId()); ?>)">Editar</button>
          <!-- Botón para eliminar una subcategoría -->
          <button class="btn btn-sm btn-danger" onclick="eliminarSubcategoria(<?php echo htmlspecialchars($subcategoria->getId()); ?>)">Eliminar</button>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Modal para añadir/editar subcategorías -->
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
        <form id="formSubcategoria">
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
                <option value="<?php echo $categoria->getID(); ?>"><?php echo $categoria->getNombre(); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
