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
    <h2 class="text-center mb-4">Tablero de Administración</h2>
    <div class="row justify-content-center align-items-center">

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">Categorías</div>
                <ul class="list-group list-group-flush">
                    <?php
                    foreach ($categorias_contador as $categoria) {
                        $categoria_id = $categoria['id'];
                        $categoria_nombre = $categoria['nombre'];
                        $categoria_cantidad = $categoria['cantidad'];
                        echo "<li class='list-group-item'>{$categoria_nombre} <a href='{$basePath}index.php?sec=productos&ruta=vistas&filtrado=categoria&categoria_id={$categoria_id}' class='badge bg-secondary float-end'>{$categoria_cantidad}</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">Marcas</div>
                <ul class="list-group list-group-flush">
                    <?php
                    foreach ($marcascantidad as $marca) {
                        $marcaId = $marca['id'];
                        $marcaTitulo = $marca['marca_titulo'];
                        $marcaCantidad = $marca['cantidad'];
                        echo "<li class='list-group-item'>{$marcaTitulo} <a href='{$basePath}index.php?sec=productos&ruta=vistas&filtrado=marca&marca_id={$marcaId}' class='badge bg-secondary float-end'>{$marcaCantidad}</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>