<?PHP
require_once '../../functions/autoload.php';
$id = $_GET['id'] ?? FALSE;

//$currentPath = $_SERVER['PHP_SELF'];
//$basePath = '';
//
//if (strpos($currentPath, '/acc/') !== false) {
//  $basePath = '../';
//}

$catalogo = new Producto();
$productos = $catalogo->producto_x_id($id);
foreach ($productos as $producto) {
    try {
        (new Imagen())->borrarImagen(__DIR__ . "../img/productos/" . $producto->getProducto_imagen());
        $producto->clear_info_adicional();
        $producto->delete();
        header('Location: ' . dirname(dirname($_SERVER['PHP_SELF'])). '/index.php?sec=productos&ruta=vistas');
    } catch (Exception $e) {
        (new Alerta())->add_alerta('danger', "Ocurrió un error inesperado, por favor pongase en contacto con el administrador de sistema.");
        header('Location: ' . dirname(dirname($_SERVER['PHP_SELF'])). '/index.php?sec=productos&ruta=vistas');
    }
}


