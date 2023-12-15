<?php
$id = $_GET['id'];
$catalogo = new Producto();
$productos = $catalogo->producto_x_id($id);

foreach ($productos as $producto) {
    ?>
    <div class="container mt-4 mb-4">
        <div class="row">

            <div class="col-md-6">
                <img class="producto_imagen_estilo" src="img/productos/<?= $producto->getProducto_imagen() ?>"
                     alt="<?= $producto->getProducto_imagen() ?>">
            </div>

            <div class="col-md-6">
                <div class="detalle_producto">
                    <h2 class="producto_titulo_estilo"><?= $producto->getProducto_nombre() ?></h2>
                    <p class="producto_descripcion_estilo"><?= $producto->getProducto_descripcion() ?></p>
                    <p class="producto_precio_estilo_formulario"><?= number_format($producto->getProducto_precio(), 2, ",", ".") ?>
                        ARS</p>

                    <div class="informacion_adicional_estilo">
                        <img src="img/detalle.png" alt="informacion adicional"> Informacion adicional

                        <?php
                        $infoAdicional = $producto->getInformacionAdicional();
                        foreach ($infoAdicional as $info) {
                            echo(!empty($info->getMedidas()) ? "<p class='producto_descripcion_estilo'>Medidas:" . $info->getMedidas() . "</p>" : "");
                            echo(!empty($info->getMaterial()) ? "<p class='producto_descripcion_estilo'>Material:" . $info->getMaterial() . "</p>" : "");
                            echo(!empty($info->getPeso()) ? "<p class='producto_descripcion_estilo'>Peso:" . $info->getPeso() . "</p>" : "");
                            echo(!empty($info->getOrigen()) ? "<p class='producto_descripcion_estilo'>Origen:" . $info->getOrigen() . "</p>" : "");

                        }

                        ?>
                    </div>
                </div>


                <form action="accion/add_item_acc.php" method="GET" class="row">
                    <div class="col-6 d-flex align-items-center">
                        <label for="q" class="fw-bold me-2">Cantidad: </label>
                        <input type="number" class="form-control" value="1" name="q" id="q">
                    </div>
                    <div class="col-6">
                        <input type="submit" value="AGREGAR A CARRITO" class="btn btn-danger w-100 fw-bold">
                        <input type="hidden" value="<?= $id ?>" name="id" id="id">

                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>