<?PHP
require_once '../../functions/autoload.php';
$id = $_GET['id'] ?? FALSE;

try {
  $producto = (new Producto())->producto_x_id($id);
  $producto->delete();
  if (!empty($producto->getProducto_imagen())) {
    (new Imagen())->borrarImagen(__DIR__ . "/../img/productos/" . $producto->getProducto_imagen());
  }

  //header('Location: index.php?sec=adm_productos');
} catch (Exception $e) {
  die("No se pudo eliminar el Producto". $e->getMessage());
}
