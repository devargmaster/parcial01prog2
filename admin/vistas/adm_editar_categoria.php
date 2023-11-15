<?php
$id = $_GET['id'] ?? FALSE;
$categoria = (new Categoria())->categoriaxid($id);
?>
<div class="">
    <form class="" action="/admin/accion/acc_editar_categoria.php?id=<?= $categoria->getId(); ?>" method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $categoria->getNombre(); ?>">
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $categoria->getDescripcion(); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Habilitada</label>
            <div>
                <input type="radio" id="habilitada_si" name="habilitada" value="1" <?= $categoria->getHabilitada() ? 'checked' : ''; ?>>
                <label for="habilitada_si">Sí</label>
            </div>
            <div>
                <input type="radio" id="habilitada_no" name="habilitada" value="0" <?= !$categoria->getHabilitada() ? 'checked' : ''; ?>>
                <label for="habilitada_no">No</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

