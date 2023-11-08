<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marca = new Marca();
    $marca->setMarcaTitulo($_POST['marca_titulo']);
    $marca->setMarcaDescripcion($_POST['marca_descripcion']);

    $resultado = $marca->insertar();

    if ($resultado) {
        header('Location: index.php?sec=adm_marca&mensaje=insertado_correctamente');
        exit;
    } else {
        echo "Error al insertar la categoría.";
    }
}
?>