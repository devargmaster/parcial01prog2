<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oferta = new Oferta();
    $oferta->setOfertaTitulo($_POST['oferta_titulo']);
    $oferta->setOfertaDescripcion($_POST['oferta_descripcion']);
    $oferta->setProductoId($_POST['productoid']);

    $resultado = $oferta->insertar();
    $alerta = new Alerta();

    if ($resultado) {
        $alerta->add_alerta('success', "Se ingreso la oferta correctamente.", "Oferta");
        header('Location: ' . dirname($_SERVER['PHP_SELF']). '/index.php?sec=oferta&ruta=vistas');
    } else {
        $alerta->add_alerta('danger', "Error al insertar la oferta.", "Oferta");
        header('Location: ' . dirname($_SERVER['PHP_SELF']). '/index.php?sec=oferta&ruta=vistas');
    }
}