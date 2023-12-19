<?php
$postData = $_POST;
$datosArchivo = $_FILES['imagen'];
$subcategoriasSeleccionadas = $_POST['subcategorias'] ?? [];
$alerta = new Alerta();
if (!empty($datosArchivo['tmp_name'])) {
    if ($datosArchivo['error'] !== UPLOAD_ERR_OK) {

        die('Error al subir el archivo: ' . $datosArchivo['error']);
    }

    $og_name = explode(".", $datosArchivo['name']);
    $extension = end($og_name);
    $filename = time() . ".$extension";
    $targetPath = '../img/productos/' . $filename;

    if (file_exists($datosArchivo['tmp_name'])) {
        $fileUpload = move_uploaded_file($datosArchivo['tmp_name'], $targetPath);
        if (!$fileUpload) {
            echo $targetPath;

            echo "Error al subir el archivo";
        } else {
            $imagen = $filename;
        }
    } else {
        die('El archivo temporal no existe.');
    }
} else {
    $imagen = "img/imagen123.png";
}
try {
    $conexion = Conexion::getConexion();
    $conexion->beginTransaction();

    $producto = new Producto();
    $producto_id = $producto->insertarProducto(
        $postData['producto_nombre'],
        $postData['producto_descripcion'],
        $postData['producto_precio'],
        $imagen,
        $postData['producto_stock'],
        $postData['producto_destacado'],
        $postData['producto_estado'],
        $postData['producto_nuevo'],
        $postData['marca_id']
    );


    if (isset($_POST['medidas']) || isset($_POST['peso']) || isset($_POST['material']) || isset($_POST['origen'])) {
        (new Informacion_adicional())->insertarInformacionAdicional(
            $_POST['medidas'],
            $_POST['peso'],
            $_POST['material'],
            $_POST['origen'],
            $producto_id
        );
    }

    if (!empty($postData['producto_categoria'])) {
        (new Productos_Categorias())->insertar($producto_id, $postData['producto_categoria']);
    }

    if (!empty($postData['subcategorias'])) {
        (new Productos_Categorias_Subcategorias())->asignarProductoASubcategorias($producto_id, $subcategoriasSeleccionadas);
    }

    $conexion->commit();
    $alerta->add_alerta('success', "Producto dado de alta!.", "Producto");
    header('Location: index.php?sec=productos&ruta=vistas');
} catch (Exception $ex) {
    if (isset($conexion)) {
        $conexion->rollBack();
    }
    $alerta->add_alerta('danger', "Ocurrió un error al dar de alta el producto. Por favor, inténtelo de nuevo.", "Producto");
    header('Location: index.php?sec=alta_producto&ruta=vistas');
}

