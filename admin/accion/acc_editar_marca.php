<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../functions/autoload.php';
$postData = $_POST;
$id = $_GET['id'] ?? FALSE;
$alerta = new Alerta();

try {
    $marca = (new Marca())->marcaxid($id);
    $marca->editar($postData['nombre'], $postData['descripcion']);
    $alerta->add_alerta('success', "Marca actualizada correctamente.", "Marca");
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=marca&ruta=vistas');
} catch (PDOException $e) {
    $alerta->add_alerta('danger', "Ocurrió un error al actualizar la marca. Por favor, inténtelo de nuevo.", "Marca");
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=editar_marca&ruta=vistas');
} finally {
    restore_error_handler();
}