<?php
require_once '../../functions/autoload.php';

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;
$alerta = new Alerta();

try {
    $subcategoria = (new Subcategoria())->subcategoriaxid($id);
    $subcategoria->setNombre($postData['nombre']);
    $subcategoria->setDescripcion($postData['descripcion']);
    $subcategoria->setCategoriaId($postData['categoria_id']);
    $subcategoria->setEsmenu($postData['es_menu']);
    $subcategoria->actualizar();
    $alerta->add_alerta('success', "Subcategoría actualizada correctamente.", "Subcategoría");
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=subcategoria&ruta=vistas');
} catch (PDOException $e) {
    $alerta->add_alerta('danger', "Ocurrió un error al actualizar la subcategoría. Por favor, inténtelo de nuevo.", "Subcategoría");
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=editar_subcategoria&ruta=vistas');
} finally {
    restore_error_handler();
}