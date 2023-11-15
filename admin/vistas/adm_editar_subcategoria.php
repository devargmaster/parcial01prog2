<?php
$id = $_GET['id'] ?? FALSE;
$subcategoria = (new Subcategoria())->subcategoriaxid($id);
$categoria = (new Categoria())->categoriaxid($subcategoria->getCategoriaId());
echo "<pre>";
var_dump($subcategoria);
echo "</pre>";
?>

<div class="">
    <form class="" action="index.html" method="post">
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
        <input type="text" class="form-control" id="categoria_id" name="categoria_id" value="<?= $categoria->getNombre() ; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
