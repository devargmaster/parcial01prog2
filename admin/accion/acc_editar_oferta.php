<?php
require_once '../../functions/autoload.php';
$postData = $_POST;
$id = $_GET['id'] ?? FALSE;
try {
    $oferta = (new Oferta())->ofertaxId($id);
    $oferta->setOfertaTitulo($postData['nombre']);
    $oferta->setOfertaDescripcion($postData['descripcion']);
    $oferta->setProductoId($postData['producto_id']);
    $oferta->editar();
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=oferta&ruta=vistas');
} catch (Exception $e) {
    echo $e->getMessage();
}