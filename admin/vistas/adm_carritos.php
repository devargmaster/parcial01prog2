<?php
$carritos = (new Carrito())->todos_los_carritos();
//echo '<pre>';
//print_r($carritos);
//echo '</pre>';
echo (new Alerta())->get_alertas();
?>
<div class="container mt-5">
    <h2>Administrar Carritos</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th class="col-auto d-none d-md-table-cell">ID</th>
                <th class="col-auto">Producto</th>
                <th class="col-auto">Cantidad</th>
                <th class="col-auto">Imagen</th>
                <th class="col-auto">Total</th>
                <th class="col-auto d-none d-md-table-cell">Fecha</th>
                <th class="col-auto d-none d-md-table-cell">Carrito</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $currentGuid = null;
            foreach ($carritos as $carrito):
                if ($carrito->getCarritoGuid() !== $currentGuid) {
                    if ($currentGuid !== null) {
                        echo '<tr><td colspan="6"><button class="btn btn-primary">Despacho de carrito</button></td></tr>';
                    }
                    $currentGuid = $carrito->getCarritoGuid();
                }
                ?>
                <tr>
                    <td class="col-auto d-none d-md-table-cell"><?= $carrito->getId(); ?></td>
                    <td class="col-auto"><?= $carrito->producto_nombre; ?></td>
                    <td class="col-auto"><?= $carrito->getCantidad(); ?></td>
                    <td class="col-auto"><img src="../img/productos/<?= $carrito->producto_imagen ?>"
                             alt="<?= $carrito->producto_nombre; ?>" style="width: 50px; height: auto;"></td>
                    <td class="col-auto"><?= number_format($carrito->getPrecio() * $carrito->getCantidad(), 2, ",", ".") ?> ARS</td>
                    <td class="col-auto d-none d-md-table-cell"><?= $carrito->getFecha(); ?></td>
                    <td class="col-auto d-none d-md-table-cell"><?= $carrito->getCarritoGuid(); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6">
                    <button class="btn btn-primary">Despacho de carrito</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>