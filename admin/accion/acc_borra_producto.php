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
      echo "borrando imagen";
      $host = $_SERVER['HTTP_HOST'];
      $directorio_borrado = dirname(dirname(dirname($_SERVER['PHP_SELF']))) . "/img/productos/" . $producto->getProducto_imagen();
      echo "<pre>";
      print_r ("Producto???: ".$producto->getProducto_imagen());
        print_r($host.$directorio_borrado);
        echo "</pre>";
    (new Imagen())->borrarImagen(__DIR__ . "/../../img/productos/" . $producto->getProducto_imagen());
  }

   header('Location: ' . dirname(dirname($_SERVER['PHP_SELF'])). '/index.php?sec=productos&ruta=vistas');
} catch (Exception $e) {
  die("No se pudo eliminar el Producto". $e->getMessage());
}
