<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../functions/autoload.php';
$id = $_GET['id'] ?? FALSE;

$alerta = new Alerta();

try {
    $categoria = (new Categoria())->categoriaxid($id);
    $categoria->eliminar();
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=categoria&ruta=vistas');
} catch (Exception $e) {
    $message = $e->getMessage();
    if (preg_match('/CONSTRAINT `(.*?)` FOREIGN KEY/', $message, $matches)) {
        $fkName = $matches[1];
        $alerta->add_alerta('danger', "No se puede eliminar debido a la restricción de la clave foránea: $fkName contacte al administrador de sistema, para mas información.", "Categoria");
    } else {
        $alerta->add_alerta('danger', "Ocurrió un error inesperado, por favor pongase en contacto con el administrador de sistema.","Categoria");
    }
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=categoria&ruta=vistas');
} finally {
    restore_error_handler();
}

