<?php
$categorias_contador= (new Categoria())->categoria_con_cantidad();
$destacados = (new Producto())->productos_destacados_cantidad_subcategoria();
echo (new Alerta())->get_alertas();
?>
<div class="container mt-4">
    <h1 class="text-center mb-4">HOME ADMIN</h1>
    <div class="row">

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100">
                <div class="card-header">Productos y Destacados</div>
                <div class="card-body">
                    <?php
                    foreach ($destacados as $destacado) {
                        echo "<p>" . $destacado['producto_nombre'] . " " . $destacado['cantidad_subcategorias'] . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>


        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">

                <div class="card-header">Categorías</div>
                <div class="card-body">
                    <?php
                    foreach ($categorias_contador as $categoria) {
                        echo "<p>" . $categoria['nombre'] . " " . $categoria['cantidad'] . "</p>";
                    }
                    ?>
                </div>
        </div>




        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100">
                <div class="card-header">Marcas</div>
                <div class="card-body">
                    <p>Mostrare las marcas relacionadas con los productos...</p>
                </div>
            </div>
        </div>
    </div>
</div>
