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
  $conexion = Conexion::getConexion();
  $conexion->beginTransaction();

  $producto = new Producto();
  $producto_id = $producto->insertarProducto(
    $postData['producto_nombre'],
    $postData['producto_descripcion'],
    $postData['producto_precio'],
    $imagen, // Asegúrate de que este campo se llame 'producto_imagen' en tu formulario
    $postData['producto_stock'],
    $postData['producto_destacado'],
    $postData['producto_estado'],
    $postData['producto_nuevo'],
    $postData['producto_fecha'],
    $postData['marca_id']
  );

  // ... después de insertar el producto y obtener $producto_id ...

  if (isset($_POST['medidas'])) {
    $conexion = Conexion::getConexion();
    $stmt = $conexion->prepare("INSERT INTO informacion_adicional (medidas, peso, material, origen, producto_id) VALUES (?, ?, ?, ?, ?)");

    // Asigna directamente los valores de la información adicional
    $medidas = $_POST['medidas'];
    $peso = $_POST['peso'];
    $material = $_POST['material'];
    $origen = $_POST['origen'];

    // Ejecuta la inserción con los valores individuales
    $stmt->execute([$medidas, $peso, $material, $origen, $producto_id]);
  }


  // Insertar en productos_categorias
  $categoria_id = $postData['producto_categoria']; // Asegúrate de que este campo exista en tu formulario
  $stmt = $conexion->prepare("INSERT INTO productos_categorias (producto_id, categoria_id) VALUES (?, ?)");
  $stmt->bindParam(1, $producto_id);
  $stmt->bindParam(2, $categoria_id);
  $stmt->execute();

  // Insertar en productos_categorias_subcategorias
  $subcategoria_id = $postData['producto_subcategoria']; // Asegúrate de que este campo exista en tu formulario
  $stmt = $conexion->prepare("INSERT INTO productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (?, ?)");
  $stmt->bindParam(1, $producto_id);
  $stmt->bindParam(2, $subcategoria_id);
  $stmt->execute();

  $conexion->commit();
  // Redireccionar al usuario a la página de productos
  header('Location: index.php?sec=adm_productos');
} catch (Exception $ex) {
  if (isset($conexion)) {
    $conexion->rollBack();
  }
  die($ex->getMessage());
}

