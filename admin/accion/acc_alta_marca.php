<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marca = new Marca();
    $marca->setMarcaTitulo($_POST['marca_titulo']);
    $marca->setMarcaDescripcion($_POST['marca_descripcion']);

    $resultado = $marca->insertar();

    if ($resultado) {
        header('Location: ' . dirname($_SERVER['PHP_SELF']). '/index.php?sec=marca&ruta=vistas');
    } else {
        echo "Error al insertar la categoría.";
    }
}
?>