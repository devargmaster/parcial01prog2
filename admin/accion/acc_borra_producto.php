<?PHP
require_once '../../functions/autoload.php';
$id = $_GET['id'] ?? FALSE;

$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

if (strpos($currentPath, '/acc/') !== false) {
  $basePath = '../';
}
try {
  $producto = (new Producto())->producto_x_id($id);
  $producto->delete();
  if (!empty($producto->getProducto_imagen())) {
    (new Imagen())->borrarImagen(__DIR__ . "/../img/productos/" . $producto->getProducto_imagen());
  }
  echo $currentPath . '<br>';
  echo $basePath . '<br>';
  echo $basePath . 'index.php?sec=productos&ruta=vistas';
  header( 'Location: index.php?sec=productos&ruta=vistas');
} catch (Exception $e) {
  die("No se pudo eliminar el Producto". $e->getMessage());
}
