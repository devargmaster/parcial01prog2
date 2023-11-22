<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subcategoria = new Subcategoria();
    $subcategoria->setNombre($_POST['nombre']);
    $subcategoria->setDescripcion($_POST['descripcion']);
    $subcategoria->setCategoriaId($_POST['categoria_id']);
    $subcategoria->setEsmenu($_POST['es_menu']);
    $resultado = $subcategoria->insertar();
    if ($resultado) {
        header('Location: ' . dirname($_SERVER['PHP_SELF']). '/index.php?sec=subcategoria&ruta=vistas');
        exit;
    } else {
        echo "Error al insertar la categoría.";
    }
}
?>