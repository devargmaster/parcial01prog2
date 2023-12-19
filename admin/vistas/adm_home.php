<?php
$categorias_contador = (new Categoria())->categoria_con_cantidad();
$destacados = (new Producto())->productos_destacados_cantidad_subcategoria();
$marcascantidad = (new Marca())->todas_las_marcas_con_cantidad();
echo (new Alerta())->get_alertas();
$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

if (str_contains($currentPath, '/vistas/')) {
    $basePath = '../';
}
?>
<div class="container mt-4">
    <h1 class="text-center mb-4">HOME ADMIN</h1>
    <div class="row justify-content-center align-items-center">

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card mb-3">
                <div class="card-header">Categorías</div>
                <div class="card-body">
                    <?php
                    foreach ($categorias_contador as $categoria) {
                        $categoria_id = $categoria['id'];
                        $categoria_nombre = $categoria['nombre'];
                        $categoria_cantidad = $categoria['cantidad'];
                        echo "<p>{$categoria_nombre} <a href='{$basePath}index.php?sec=productos&ruta=vistas&filtrado=categoria&categoria_id={$categoria_id}' class='links_general'>{$categoria_cantidad}</a></p>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100">
                <div class="card-header">Marcas</div>
                <div class="card-body">
                    <?php

                    foreach ($marcascantidad as $marca) {
                        $marcaId = $marca['id'];
                        $marcaTitulo = $marca['marca_titulo'];
                        $marcaCantidad = $marca['cantidad'];
                        echo "<p>{$marcaTitulo} <a href='{$basePath}index.php?sec=productos&ruta=vistas&filtrado=marca&marca_id={$marcaId}'>{$marcaCantidad}</a></p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
