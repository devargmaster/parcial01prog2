<?php
$postData = $_POST;
$datosArchivo = $_FILES['imagen'];
$subcategoriasSeleccionadas = $_POST['subcategorias'] ?? [];

echo "<pre>";
print_r($subcategoriasSeleccionadas);
echo "</pre>";

//echo "<pre>";
//print_r($datosArchivo);
//echo "</pre>";
//echo "<pre>";
//print_r($datosArchivo);
//echo "</pre>";
if (!empty($datosArchivo['tmp_name'])) {

  $og_name = explode(".", $datosArchivo['name']);
  $extension = end($og_name);
  $filename = time() . ".$extension";

  $fileUpload = move_uploaded_file($datosArchivo['tmp_name'], "../img/productos/$filename");

  if (!$fileUpload) {
    die('no se pudo subir la imagen');
  }else{
    $imagen = $filename;
  }
  print_r($og_name);
}else{
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
        $categoria_id = $postData['producto_categoria'];
        $stmt = $conexion->prepare("INSERT INTO productos_categorias (producto_id, categoria_id) VALUES (?, ?)");
        $stmt->execute([$producto_id, $categoria_id]);
    }

    if (!empty($postData['subcategorias'])) {
        (new Productos_Categorias_Subcategorias())->asignarProductoASubcategorias($producto_id, $subcategoriasSeleccionadas);
    }

  $conexion->commit();

  //header('Location: index.php?sec=productos&ruta=vistas');
} catch (Exception $ex) {
  if (isset($conexion)) {
    $conexion->rollBack();
  }
  die($ex->getMessage());
}

