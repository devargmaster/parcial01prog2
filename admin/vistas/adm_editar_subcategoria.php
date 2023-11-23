<?php
$id = $_GET['id'] ?? FALSE;
$subcategoria = (new Subcategoria())->subcategoriaxid($id);
$categorias_completas = (new Categoria())->categorias_completas();
?>

<div class="">
    <form class="" action="accion/acc_editar_subcategoria.php?id=<?= $subcategoria->getId(); ?>" method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $subcategoria->getNombre(); ?>">
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $subcategoria->getDescripcion(); ?>">
        </div>
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <select class="form-control" id="categoria_id" name="categoria_id">
                <?php foreach ($categorias_completas as $categoria): ?>
                    <option value="<?= $categoria['id']; ?>" <?= $categoria['id'] == $subcategoria->getCategoriaId() ? 'selected' : ''; ?>>
                        <?= $categoria['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">¿Es Menú?</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="es_menu" id="esMenuSi" value="1" <?= $subcategoria->getEsmenu() ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="esMenuSi">Sí</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="es_menu" id="esMenuNo" value="0" <?= !$subcategoria->getEsmenu() ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="esMenuNo">No</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
