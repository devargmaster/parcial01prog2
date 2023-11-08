<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoria = new Categoria();
    $categoria->setNombre($_POST['nombre']);
    $categoria->setDescripcion($_POST['descripcion']);
    $habilitada = isset($_POST['habilitada']) ? 1 : 0;
    $categoria->setHabilitada($habilitada);
    $resultado = $categoria->insertar();

    if ($resultado) {
        header('Location: tu_pagina_de_categorias.php?mensaje=insertado_correctamente');
        exit;
    } else {
        // Manejar el error aquí
        echo "Error al insertar la categoría.";
    }
}
?>