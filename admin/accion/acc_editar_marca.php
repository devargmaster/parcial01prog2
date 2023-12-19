<?php
require_once '../../functions/autoload.php';
$postData = $_POST;
$id = $_GET['id'] ?? FALSE;
$alerta = new Alerta();

try {
    $marca = (new Marca())->marcaxid($id);
    $marca->setMarcaTitulo($postData['nombre']);
    $marca->setMarcaDescripcion($postData['descripcion']);
    $marca->editar();
    $alerta->add_alerta('success', "Marca actualizada correctamente.", "Marca");
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=marca&ruta=vistas');
} catch (PDOException $e) {
    $alerta->add_alerta('danger', "Ocurrió un error al actualizar la marca. Por favor, inténtelo de nuevo.", "Marca");
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=editar_marca&ruta=vistas');
} finally {
    restore_error_handler();
}