<?php
require_once '../../functions/autoload.php';

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;
try {
    $marca = (new Marca())->marcaxid($id);
    $marca->setMarcaTitulo($postData['nombre']);
    $marca->setMarcaDescripcion($postData['descripcion']);
    $marca->editar();
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=marca&ruta=vistas');
} catch (Exception $e) {
    echo $e->getMessage();
}
