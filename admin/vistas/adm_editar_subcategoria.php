<?php
$id = $_GET['id'] ?? FALSE;
$subcategoria = (new Subcategoria())->subcategoriaxid($id);
$categorias_completas = (new Categoria())->categorias_completas();
?>

<div class="">
    <form class="" action="/admin/accion/acc_editar_subcategoria.php?id=<?= $subcategoria->getId(); ?>" method="post">
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
                    <option value="<?= $categoria->getID(); ?>" <?= $categoria->getID() == $subcategoria->getCategoriaId() ? 'selected' : ''; ?>>
                        <?= $categoria->getNombre(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
