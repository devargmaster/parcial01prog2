<?php
require_once '../../functions/autoload.php';

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;
try {
    $subcategoria = (new Subcategoria())->subcategoriaxid($id);
    $subcategoria->setNombre($postData['nombre']);
    $subcategoria->setDescripcion($postData['descripcion']);
    $subcategoria->setCategoriaId($postData['categoria_id']);
    $subcategoria->actualizar();
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=subcategoria&ruta=vistas');
} catch (Exception $e) {
    echo $e->getMessage();
}
