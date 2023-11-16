<?php
require_once '../../functions/autoload.php';
$postData = $_POST;
$producto = new Producto();
$imagen = new Imagen();

$productoId = $_GET['id'] ?? FALSE;
$nombre = $postData['nombre'] ?? '';
$descripcion = $postData['descripcion'] ?? '';
$precio = $postData['precio'] ?? '';
$categoria = $postData['categoria_id'] ?? '';
$subcategoria = $postData['subcategoria_id'] ?? '';
$marca = isset($postData['marca_id']) ? (int)$postData['marca_id'] : null;
$stock = $postData['stock'] ?? '';
$destacado = $postData['destacado'] ?? '';
$estado = $postData['estado'] ?? '';
$nuevo = $postData['nuevo'] ?? '';

echo "<pre>";
print_r($_POST);
echo "</pre>";

$producto->producto_x_id($productoId);
$producto->actualizar_producto( $productoId,$nombre, $descripcion, $precio, $stock,$marca);
