<?php

$carrito = new Carrito();
$items = $carrito->get_carrito();

if (count($items) == 0) {
    header("Location: " . dirname($_SERVER['PHP_SELF']) . '/index.php?sec=carrito&ruta=vistas');
    exit();
}
?>

<h2 class="text-center fs-2 my-5">Resumen de su Compra</h2>
<div class="container my-4">
    <table class="table">
        <tbody>
        <?php foreach ($items as $item) { ?>
            <tr>
                <td><img src="img/productos/<?= $item['imagen'] ?>" alt="Imagen de <?= $item['producto'] ?>" class="img-fluid rounded shadow-sm" style="width: 100px; height: auto;"></td>
                <td><?= $item['producto'] ?></td>
                <td><?= $item['cantidad'] ?></td>
                <td>$<?= number_format($item['precio'], 2, ",", ".") ?></td>
                <td>$<?= number_format($item['cantidad'] * $item['precio'], 2, ",", ".") ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <h3 class="text-center fs-3 my-4">Detalles del Envío</h3>
    <form action="index.php?sec=procesar_pago" method="post">
        <div class="mb-3">
            <label for="nombreCompleto" class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" id="nombreCompleto" name="nombreCompleto" >
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección de Entrega</label>
            <input type="text" class="form-control" id="direccion" name="direccion" >
        </div>
        <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" >
        </div>
        <div class="mb-3">
            <label for="codigoPostal" class="form-label">Código Postal</label>
            <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" >
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono de Contacto</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" >
        </div>
        <div class="mb-3">
            <label for="metodoEnvio" class="form-label">Método de Envío</label>
            <select class="form-select" id="metodoEnvio" name="metodoEnvio">
                <option value="estandar">Estándar</option>
                <option value="express">Express</option>
                <option value="internacional">Internacional</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="comentarios" class="form-label">Comentarios Adicionales</label>
            <textarea class="form-control" id="comentarios" name="comentarios" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Finalizar Compra</button>
    </form>
</div>
