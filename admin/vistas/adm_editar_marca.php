<?php
$id = $_GET['id'] ?? FALSE;
$marca = (new Marca())->marcaxid($id);
?>
<div class="">
    <?= $marca->getId() ?>
    <form  action="/admin/accion/acc_editar_marca.php?id=<?= $marca->getId(); ?>" method="POST">
        <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $marca->getMarcaTitulo(); ?>">
        </div>
        <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $marca->getMarcaDescripcion(); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

