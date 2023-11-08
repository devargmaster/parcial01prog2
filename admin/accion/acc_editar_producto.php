<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Obtiene los valores del formulario
  $productoId = $_POST['producto_id'];
  $nombre = $_POST['producto_nombre'];
  // Y así sucesivamente para cada campo del formulario

  // Aquí deberías validar los datos recibidos

  // Luego, actualizas los datos del producto en la base de datos
  $actualizar = (new Producto())->actualizar_producto($productoId, $nombre);
  // Pseudocódigo: actualizar_producto($productoId, $nombre, ...);

  // Finalmente, rediriges al usuario a la página de administración o muestras un mensaje de éxito/error
  header( 'Location: index.php?sec=productos&ruta=vistas');
}
?>
