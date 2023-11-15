<?php
$id = $_GET['id'] ?? FALSE;
$oferta = (new Oferta())->ofertaxId($id);
?>
<div class="">
    <form class="" action="index.html" method="post">
        <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $oferta->getOfertaTitulo(); ?>">
        </div>
        <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $oferta->getOfertaDescripcion(); ?>">
        </div>
        <div class="mb-3">
        <label for="producto_id" class="form-label">Producto</label>
        <input type="text" class="form-control" id="producto_id" name="producto_id" value="<?= $oferta->getNombreProducto() ; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>



