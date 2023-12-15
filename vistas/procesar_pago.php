<?php
if (!isset($_SESSION['loggedIn']['username']) || count((new Carrito())->get_carrito()) == 0) {
    header("Location: " . dirname($_SERVER['PHP_SELF']) . '/index.php?sec=carrito&ruta=vistas');
    exit();
}
$carrito = new Carrito();
$carrito->save_session_items_to_db($_SESSION['loggedIn']['id']);
$carrito->clear_items();
unset($_SESSION['carritoGUID']);
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card text-center">
                <div class="card-header">
                    Confirmación de Pedido
                </div>
                <div class="card-body">
                    <h5 class="card-title">¡Gracias por tu compra!</h5>
                    <p class="card-text">Tus datos fueron procesados , y tu pedido será enviado a la dirección que ingresaste.</p>
                    <a href="index.php" class="btn btn-primary">Volver a comprar</a>
                </div>
                <div class="card-footer text-muted">
                    Tu pedido será procesado inmediatamente.
                </div>
            </div>
        </div>
    </div>
</div>