<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoria = new Categoria();
    $categoria->setNombre($_POST['nombre']);
    $categoria->setDescripcion($_POST['descripcion']);
    $habilitada = isset($_POST['habilitada']) ? 1 : 0;
    $categoria->setHabilitada($habilitada);
    $categoria->setEsMenu($_POST['es_menu']);
    $resultado = $categoria->insertar();

    if ($resultado) {
        header('Location: ' . dirname($_SERVER['PHP_SELF']). '/index.php?sec=categoria&ruta=vistas');
        exit;
    } else {
        echo "Error al insertar la categoría.";
    }
}
?>