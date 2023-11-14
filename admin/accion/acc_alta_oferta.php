<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oferta = new Oferta();
    $oferta->setOfertaTitulo($_POST['oferta_titulo']);
    $oferta->setOfertaDescripcion($_POST['oferta_descripcion']);
    $oferta->setProductoId($_POST['productoid']);

    $resultado = $oferta->insertar();

    if ($resultado) {
        header('Location: ' . dirname($_SERVER['PHP_SELF']). '/index.php?sec=oferta&ruta=vistas');
    } else {
        echo "Error al insertar la categoría.";
    }
}
?>