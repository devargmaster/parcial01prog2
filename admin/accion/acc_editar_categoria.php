<?php
require_once '../../functions/autoload.php';
$postData = $_POST;
$id = $_GET['id'] ?? FALSE;
$alerta = new Alerta();

try {
    $categoria = (new Categoria())->categoriaxid($id);
    $categoria->setNombre($postData['nombre']);
    $categoria->setDescripcion($postData['descripcion']);
    $categoria->setHabilitada($postData['habilitada']);
    $categoria->setEsMenu($postData['es_menu']);
    $categoria->editar();
    $alerta->add_alerta('success', "Categoría actualizada correctamente.", "Categoría");
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=categoria&ruta=vistas');
} catch (PDOException $e) {
    $alerta->add_alerta('danger', "Ocurrió un error al actualizar la categoría. Por favor, inténtelo de nuevo.", "Categoría");
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=editar_categoria&ruta=vistas');
} finally {
    restore_error_handler();
}