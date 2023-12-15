<?php
$carritos = (new Carrito())->todos_los_carritos();
//echo '<pre>';
//print_r($carritos);
//echo '</pre>';
?>
<div class="container mt-5">
    <h2>Administrar Carritos</h2>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Imagen</th>
            <th>Total</th>
            <th>Carrito</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $currentGuid = null;
        foreach($carritos as $carrito):
            if ($carrito->getCarritoGuid() !== $currentGuid) {
                if ($currentGuid !== null) {
                    echo '<tr><td colspan="6"><button class="btn btn-primary">Despacho de carrito</button></td></tr>';
                }
                $currentGuid = $carrito->getCarritoGuid();
            }
            ?>
            <tr>
                <td><?= $carrito->getId(); ?></td>
                <td><?= $carrito->producto_nombre; ?></td>
                <td><?= $carrito->getCantidad(); ?></td>
                <td><img src="../img/productos/<?= $carrito->producto_imagen ?>" alt="<?= $carrito->producto_nombre; ?>" style="width: 50px; height: auto;"></td>
                <td><?= number_format($carrito->getPrecio() * $carrito->getCantidad(), 2, ",", ".") ?> ARS</td>
                <td><?= $carrito->getCarritoGuid(); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr><td colspan="6"><button class="btn btn-primary">Despacho de carrito</button></td></tr>
        </tbody>
    </table>
</div>