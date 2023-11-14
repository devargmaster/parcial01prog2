<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoria = new Categoria();
    $categoria->setNombre($_POST['nombre']);
    $categoria->setDescripcion($_POST['descripcion']);
    $habilitada = isset($_POST['habilitada']) ? 1 : 0;
    $categoria->setHabilitada($habilitada);
    $resultado = $categoria->insertar();

    if ($resultado) {
        header('Location: ' . dirname($_SERVER['PHP_SELF']). '/index.php?sec=categoria&ruta=vistas');
        exit;
    } else {
        echo "Error al insertar la categoría.";
    }
}
?>