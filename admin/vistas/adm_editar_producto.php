<?php
$productoId = $_GET['id']?? FALSE;
$producto = (new Producto())->producto_x_id($productoId);
$marcas = (new Marca())->todas_las_marcas();
$categorias = (new Categoria())->categorias_completas();
$subcategorias = (new Subcategoria())->subcategorias_completas();
?>
<div class="">
    <form class="" action="index.html" method="post">
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
                <option value="<?= $categoria->getID(); ?>" <?= $categoria->getID() == $producto->getProducto_categoria() ? 'selected' : ''; ?>><?= $categoria->getNombre(); ?></option>
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
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen Actual</label>
            <!-- Asegúrate de proporcionar la ruta correcta a la imagen -->
            <img src="../img/productos/<?= $producto->getProducto_imagen(); ?>" alt="Imagen del producto" width="100" height="100">
            <input type="file" class="form-control" id="imagen" name="imagen_nueva">
            <input type="hidden" name="imagen_actual" value="<?= $producto->getProducto_imagen(); ?>">
            <p>Cargar una nueva imagen reemplazará a la actual.</p>
        </div>
        <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="text" class="form-control" id="stock" name="stock" value="<?= $producto->getProductoStock(); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

