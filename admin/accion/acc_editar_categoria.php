<?php
require_once '../../functions/autoload.php';

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;
try {
    $categoria = (new Categoria())->categoriaxid($id);
    $categoria->setNombre($postData['nombre']);
    $categoria->setDescripcion($postData['descripcion']);
    $categoria->setHabilitada($postData['habilitada']);
    $categoria->editar();
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=categoria&ruta=vistas');
} catch (Exception $e) {
    echo $e->getMessage();
}
