<?php
$postData = $_POST;
$datosArchivo = $_FILES['imagen'];
echo "<pre>";
print_r($datosArchivo);
echo "</pre>";
echo "<pre>";
print_r($datosArchivo);
echo "</pre>";
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

  (new Producto())->insertarProducto(
    $postData['producto_nombre'],
    $postData['producto_descripcion'],
    $postData['producto_precio'],
    $postData['producto_imagen']=$imagen,
    $postData['producto_stock'],
    $postData['producto_destacado'],
    $postData['producto_estado'],
    $postData['producto_oferta_id'],
    $postData['producto_nuevo'],
    $postData['producto_fecha'],
    $postData['marca_id']
  );
 // header('Location: index.php?sec=adm_productos');
} catch (Exception $ex) {
  die ($ex->getMessage());
}

