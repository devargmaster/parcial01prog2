<?php
$marcas = (new Marca())->todas_las_marcas();
$categorias = (new Categoria())->categorias_completas();
$subcategorias = (new Subcategoria())->subcategorias_completas();
//echo "<pre>";
//print_r($subcategorias);
//echo "</pre>";
echo (new Alerta())->get_alertas();
?>
<div class="container mt-5">
    <h2>Agregar Nuevo Producto</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form id="addProductForm" action="index.php?sec=alta_producto&ruta=acc" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="productoNombre">Nombre del Producto</label>
                    <input type="text" class="form-control" id="productoNombre" name="producto_nombre" required>
                </div>
                <div class="form-group">
                    <label for="productoDescripcion">Descripción del Producto</label>
                    <textarea class="form-control" id="productoDescripcion" name="producto_descripcion"
                              rows="3"></textarea>
                </div>
                <hr>
                <button type="button" id="toggleInfoAdicional" class="btn btn-secondary">Agregar Información Adicional
                </button>

                <div id="informacionAdicionalContainer" style="display:none;">
                    <h4>Información Adicional</h4>
                    <div class="form-group">
                        <label for="medidas">Medidas</label>
                        <input type="text" class="form-control" id="medidas" name="medidas"
                               placeholder="Ingrese las medidas">
                    </div>
                    <div class="form-group">
                        <label for="peso">Peso</label>
                        <input type="text" class="form-control" id="peso" name="peso" placeholder="Ingrese el peso">
                    </div>
                    <div class="form-group">
                        <label for="material">Material</label>
                        <input type="text" class="form-control" id="material" name="material"
                               placeholder="Ingrese el material">
                    </div>
                    <div class="form-group">
                        <label for="origen">Origen</label>
                        <input type="text" class="form-control" id="origen" name="origen"
                               placeholder="Ingrese el origen">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="productoPrecio">Precio del Producto</label>
                    <input type="number" step="0.01" class="form-control" id="productoPrecio" name="producto_precio"
                           required>
                </div>

                <div class="form-group">
                    <label for="productoStock">Stock del Producto</label>
                    <input type="number" class="form-control" id="productoStock" name="producto_stock" required>
                </div>
                <div class="form-group">
                    <label for="marcaId">Marca</label>
                    <select class="form-select" id="marcaId" name="marca_id">
                        <?php foreach ($marcas as $marca): ?>
                            <option value="<?= $marca->getId() ?>"><?= $marca->getMarcaTitulo() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="imagen" class="form-label">Imagen del producto</label>
                    <input class="form-control" type="file" id="imagen" name="imagen" required>
                </div>
                <div class="form-group">
                    <label for="productoCategoria">Categoría del Producto</label>
                    <select class="form-select" id="productoCategoria" name="producto_categoria">
                        <option value="">Seleccione una categoría</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="productoSubcategoria">Subcategoría del Producto</label><br>
                    <?php foreach ($subcategorias as $subcategoria): ?>
                        <label>
                            <input type="checkbox" name="subcategorias[]" value="<?= $subcategoria['id'] ?>">
                            <?= $subcategoria['nombre'] ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
                <div class="form-group">
                    <label for="producto_estado">Activo:</label>
                    <input type="radio" id="producto_estado_si" name="producto_estado" value="1" checked>
                    <label for="producto_estado_si">Sí</label>
                    <input type="radio" id="producto_estado_no" name="producto_estado" value="0">
                    <label for="producto_estado_no">No</label>
                </div>

                <div class="form-group">
                    <label for="producto_nuevo">Producto Nuevo:</label>
                    <input type="radio" id="producto_nuevo_si" name="producto_nuevo" value="1" checked>
                    <label for="producto_nuevo_si">Sí</label>
                    <input type="radio" id="producto_nuevo_no" name="producto_nuevo" value="0">
                    <label for="producto_nuevo_no">No</label>
                </div>

                <div class="form-group">
                    <label for="producto_destacado">Destacado:</label>
                    <input type="radio" id="producto_destacado_si" name="producto_destacado" value="1" checked>
                    <label for="producto_destacado_si">Sí</label>
                    <input type="radio" id="producto_destacado_no" name="producto_destacado" value="0">
                    <label for="producto_destacado_no">No</label>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Agregar Producto</button>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('informacionAdicionalContainer');
        const toggleButton = document.getElementById('toggleInfoAdicional');

        toggleButton.addEventListener('click', function () {
            if (container.style.display === 'none') {
                container.style.display = 'block';
                toggleButton.textContent = 'Ocultar Información Adicional';
            } else {
                container.style.display = 'none';
                toggleButton.textContent = 'Agregar Información Adicional';
            }
        });
    });
</script>
