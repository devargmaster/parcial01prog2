<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subcategoria = new Subcategoria();
    $subcategoria->setNombre($_POST['nombre']);
    $subcategoria->setDescripcion($_POST['descripcion']);
    $subcategoria->setCategoriaId($_POST['categoria_id']);
    $subcategoria->setEsmenu($_POST['es_menu']);
    $resultado = $subcategoria->insertar();
    $alerta = new Alerta();

    if ($resultado) {
        $alerta->add_alerta('success', "Subcategoría insertada correctamente.", "Subcategoría");
        header('Location: ' . dirname($_SERVER['PHP_SELF']). '/index.php?sec=subcategoria&ruta=vistas');
        exit;
    } else {
        $alerta->add_alerta('danger', "Error al insertar la subcategoría.", "Subcategoría");
        header('Location: ' . dirname($_SERVER['PHP_SELF']). '/index.php?sec=alta_subcategoria&ruta=vistas');
    }
}
?>