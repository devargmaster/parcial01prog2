<?php
$productoId = $_GET['id']?? FALSE;
$producto = (new Producto())->producto_x_id($productoId);
$marcas = (new Marca())->todas_las_marcas();
$categorias = (new Categoria())->categorias_completas();
$subcategorias = (new Subcategoria())->subcategorias_completas();
$idcategoriaxproductoid = (new Categoria())->categoriaxproducto($producto->getId());
$idsubcategoriaxproductoid = (new Subcategoria())->subcategoriaxproducto($producto->getId());

if (is_object($idcategoriaxproductoid)) {
    $categoriaId = $idcategoriaxproductoid->getCategoriaId();
} else {
    $categoriaId = null;
}
if (is_object($idsubcategoriaxproductoid)) {
    $subcategoriaId = $idsubcategoriaxproductoid->getSubcategoriaId();
} else {
    $subcategoriaId = null;
}

?>
<div class="">
    <form  action="/admin/accion/acc_editar_producto.php?id=<?= $producto->getId(); ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $producto->getProducto_nombre(); ?>">
        </div>
        <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea  class="form-control" id="descripcion" name="descripcion" ><?= $producto->getProducto_descripcion(); ?></textarea>
        </div>
        <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="text" class="form-control" id="precio" name="precio" value="<?= $producto->getProducto_precio(); ?>">
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <select class="form-select" id="categoria_id" name="categoria_id">
                <option value="" <?php echo is_null($categoriaId) ? 'selected' : ''; ?>>Seleccione una categoría</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id']; ?>" <?= $idcategoriaxproductoid && $idcategoriaxproductoid->getCategoriaId() == $categoria['id'] ? 'selected' : ''; ?>>
                        <?= $categoria['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="productoSubcategoria">Subcategoría del Producto</label><br>
            <?php foreach ($subcategorias as $subcategoria): ?>
                <label>
                    <?php
                    echo '<input type="hidden" name="todasSubcategorias[]" value="' . $subcategoria['id'] . '">';
                    $checked = in_array($subcategoria['id'], $idsubcategoriaxproductoid) ? 'checked' : '';
                    ?>
                    <input type="checkbox" name="subcategorias[]" value="<?= $subcategoria['id'] ?>" <?= $checked ?>>
                    <?= $subcategoria['nombre'] ?>
                </label><br>
            <?php endforeach; ?>
        </div>
        <div class="mb-3">
        <label for="marca_id" class="form-label">Marca</label>
            <select class="form-select" id="marca_id" name="marca_id">
                <?php foreach ($marcas as $marca): ?>
                    <option value="<?= $marca->getId(); ?>" >
                        <?= $marca->getMarcaTitulo(); ?>
                    </option>
                <?php endforeach; ?>
            </select>

        </div>
        <div class="col-md-2 mb-3">
            <label for="imagen" class="form-label">Imágen actual</label>
            <img src="../img/productos/<?= $producto->getProducto_imagen() ?>" alt="Imágen Illustrativa de <?= $producto->getProducto_nombre() ?>" class="img-fluid rounded shadow-sm d-block">
            <input class="form-control" type="hidden" id="imagen_og" name="imagen_og" value="<?= $producto->getProducto_imagen() ?>">
        </div>
        <div class="col-md-4 mb-3">
            <label for="imagen" class="form-label">Reemplazar Imagen</label>
            <input class="form-control" type="file" id="imagen" name="imagen">
        </div>
        <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="text" class="form-control" id="stock" name="stock" value="<?= $producto->getProductoStock(); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Estado</label>
            <div>
                <input type="radio" id="activo" name="estado" value="1" <?= $producto->getProductoEstado() == 1 ? 'checked' : ''; ?>>
                <label for="activo">Activo</label>
            </div>
            <div>
                <input type="radio" id="inactivo" name="estado" value="0" <?= $producto->getProductoEstado() == 0 ? 'checked' : ''; ?>>
                <label for="inactivo">Inactivo</label>
            </div>
        </div>
        <div class="mb-3">
        <label class="form-label">Destacado</label>
        <div>
            <input type="radio" id="destacado" name="destacado" value="1" <?= $producto->getProductoDestacado() == 1 ? 'checked' : ''; ?>>
            <label for="destacado">Destacado</label>
        </div>
        <div>
            <input type="radio" id="no_destacado" name="destacado" value="0" <?= $producto->getProductoDestacado() == 0 ? 'checked' : ''; ?>>
            <label for="no_destacado">No destacado</label>
        </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

