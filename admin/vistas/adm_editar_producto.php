<?php
$productoId = $_GET['id']?? FALSE;
$producto = (new Producto())->producto_x_id($productoId);
$marcas = (new Marca())->todas_las_marcas();
$categorias = (new Categoria())->categorias_completas();
$subcategorias = (new Subcategoria())->subcategorias_completas();
$categoriaxid = (new Categoria())->categoriaxproducto($producto->getId());
echo "<pre>";
print_r($producto);
echo "</pre>";
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
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id']; ?>" <?= $categoriaxid->getCategoriaId() == $categoria['id'] ? 'selected' : ''; ?>><?= $categoria['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
        <label for="subcategoria_id" class="form-label">Subcategoría</label>
        <select class="form-select" id="subcategoria_id" name="subcategoria_id">
            <?php foreach ($subcategorias as $subcategoria): ?>
                <option value="<?= $subcategoria['id']; ?>" <?= $subcategoria['id'] == $producto->getProducto_subcategoria() ? 'selected' : ''; ?>><?= $subcategoria['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="mb-3">
        <label for="marca_id" class="form-label">Marca</label>
        <select class="form-select" id="marca_id" name="marca_id">
            <?php foreach ($marcas as $marca): ?>
                <option value="<?= $marca->getId(); ?>" <?= $marca->getId() == $producto->getProductoMarca() ? 'selected' : ''; ?>><?= $marca->getMarcaTitulo(); ?></option>
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
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

