<?PHP
$archivo = 'vistas/' . $seccion_elegida_ . '.php';
//if (file_exists($archivo)) {
//  require_once 'vistas/' . $seccion_elegida_ . '.php';
//} else {
//  require_once 'vistas/404.php';
//}
require_once __DIR__ . '/../clases/Producto.php';

$productoObj = new Producto();

$productos = []; // Array para almacenar los productos filtrados

if (isset($_GET['sec']) && !isset($_GET['subsec'])) {
  // Si solo se ha especificado una categoría
  $categoriaDescripcion = $_GET['sec'];
  $productos = $productoObj->obtenerProductosPorCategoriaDescripcion($categoriaDescripcion);
} elseif (isset($_GET['sec']) && isset($_GET['subsec'])) {
  // Si se ha especificado una categoría y una subcategoría
  $subcategoriaDescripcion = $_GET['subsec'];
  $productos = $productoObj->obtenerProductosPorSubCategoriaDescripcion($subcategoriaDescripcion);
} else {
  // Si no se ha especificado ninguna categoría o subcategoría, muestra todos los productos
  $productos = $productoObj->todos_los_productos();
}

?>
