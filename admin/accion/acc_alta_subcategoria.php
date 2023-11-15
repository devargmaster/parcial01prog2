<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoria = new Subcategoria();
    $categoria->setNombre($_POST['nombre']);
    $categoria->setDescripcion($_POST['descripcion']);
    $categoria->setCategoriaId($_POST['categoria_id']);
    $resultado = $categoria->insertar();
    if ($resultado) {
        header('Location: ' . dirname($_SERVER['PHP_SELF']). '/index.php?sec=subcategoria&ruta=vistas');
        exit;
    } else {
        echo "Error al insertar la categoría.";
    }
}
?>