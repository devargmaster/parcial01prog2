<?php
require_once '../../functions/autoload.php';

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;
$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
try {
    $marca = (new Marca())->marcaxid($id);
    $marca->editar($nombre, $descripcion);
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=marca&ruta=vistas');
} catch (Exception $e) {
    echo $e->getMessage();
}
