<?PHP
require_once dirname(__DIR__) .  '/clases/Producto.php';
$producto = new Producto();

if (isset($_GET['subsec'])) {
  $productos = $producto->obtenerProductosPorSubCategoriaDescripcion($_GET['subsec']);
} elseif (isset($_GET['sec'])) {
  $productos = $producto->obtenerProductosPorCategoriaDescripcion($_GET['sec']);
} else {
  $productos = $producto->todos_los_productos();
}

$archivo = 'vistas/' . $seccion_elegida_ . '.php';
if (file_exists($archivo)) {
  require_once 'vistas/' . $seccion_elegida_ . '.php';
} else {
  require_once 'vistas/404.php';
}


?>
