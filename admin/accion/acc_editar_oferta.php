<?php
require_once '../../functions/autoload.php';
$postData = $_POST;
$id = $_GET['id'] ?? FALSE;
$alerta = new Alerta();

try {
    $oferta = (new Oferta())->ofertaxIdBack($id);
    $oferta->setOfertaTitulo($postData['nombre']);
    $oferta->setOfertaDescripcion($postData['descripcion']);
    $oferta->setProductoId($postData['producto_id']);
    $oferta->editar();
    $alerta->add_alerta('success', "Oferta actualizada correctamente.", "Oferta");
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=oferta&ruta=vistas');
} catch (PDOException $e) {
    $alerta->add_alerta('danger', "Ocurrió un error al actualizar la oferta. Por favor, inténtelo de nuevo.", "Oferta");
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=editar_oferta&ruta=vistas');
} finally {
    restore_error_handler();
}