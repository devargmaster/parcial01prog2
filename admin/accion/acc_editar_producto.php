<?php
require_once '../../functions/autoload.php';
$postData = $_POST;
$productoId = $_GET['id'] ?? FALSE;
$fileData = $_FILES['imagen'];

echo "<pre>";
print_r($_POST);
echo "</pre>";


try {
    $producto = (new Producto())->producto_x_id($productoId);

    if (!empty($fileData['tmp_name'])) {

        $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../img/productos", $fileData);

        if (!empty($postData['imagen_og'])) {
            (new Imagen())->borrarImagen(__DIR__ . "/../../img/productos/" . $postData['imagen_og']);
        }

    } else {
        $imagen = $postData['imagen_og'];
    }

    echo "<pre>";
    print_r($producto);
    echo "</pre>";

    $id = $producto->getID();
    $marca_id = intval($postData['marca_id']);


    $producto->actualizar_producto(
        $id,
        $postData['nombre'],
        $postData['descripcion'],
        floatval($postData['precio']),
        intval($postData['stock']),
        $marca_id,
        $imagen
    );
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=productos&ruta=vistas');
    die();
}
catch (Exception $e) {
    echo $e->getMessage();
}