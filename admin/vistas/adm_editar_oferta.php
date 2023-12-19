<?php
$id = $_GET['id'] ?? FALSE;
$oferta = (new Oferta())->ofertaxIdBack($id);
$productos = (new Producto())->todos_los_productos();
?>
<div class="">
    <form class="" action="accion/acc_editar_oferta.php?id=<?= $oferta->getId(); ?>" method="post">
        <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $oferta->getOfertaTitulo(); ?>">
        </div>
        <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $oferta->getOfertaDescripcion(); ?>">
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <select class="form-control" id="producto_id" name="producto_id">
                <?php foreach ($productos as $producto): ?>
                    <option value="<?= $producto->getID(); ?>" <?= $producto->getID() == $producto->getProducto_nombre() ? 'selected' : ''; ?>>
                        <?= $producto->getProducto_nombre(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>



