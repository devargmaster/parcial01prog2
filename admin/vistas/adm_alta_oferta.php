<?php
$productos = (new Producto())->todos_los_productos();

?>
<div class="container mt-5">
    <h2>Agregar Nueva Oferta</h2>
    <form id="addOfertaForm" action="index.php?sec=alta_oferta&ruta=acc" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="ofertaTitulo">Titulo Oferta</label>
            <input type="text" class="form-control" id="oferta_titulo" name="oferta_titulo" required>
        </div>
        <div class="form-group">
            <label for="ofertaDescripcion">Descripción oferta</label>
            <textarea class="form-control" id="oferta_descripcion" name="oferta_descripcion" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="productoSubcategoria">Subcategoría del Producto</label>
            <select class="form-select" id="productoid" name="productoid">
                <?php foreach ($productos as $producto): ?>
                    <option value="<?= $producto->getId() ?>"><?= $producto->getProducto_nombre() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Agregar Oferta</button>

    </form>
</div>



