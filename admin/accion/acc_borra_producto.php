<?PHP
require_once '../../functions/autoload.php';
$id = $_GET['id'] ?? FALSE;

$catalogo = new Producto();
$productos = $catalogo->producto_x_id($id);
$alerta = new Alerta();
foreach ($productos as $producto) {
    try {
        (new Imagen())->borrarImagen(__DIR__ . "../img/productos/" . $producto->getProducto_imagen());
        $producto->clear_info_adicional();
        $producto->delete();
        $alerta->add_alerta('success', "Producto eliminado correctamente.", "Producto");
        header('Location: ' . dirname(dirname($_SERVER['PHP_SELF'])). '/index.php?sec=productos&ruta=vistas');
    } catch (PDOException $e) {
        $alerta = new Alerta();
        if ($e->getCode() == 23000) {
            preg_match('/CONSTRAINT `(.*?)` FOREIGN KEY/', $e->getMessage(), $matches);
            $fkName = $matches[1] ?? '';
            $alerta->add_alerta('danger', "No se puede eliminar debido a la restricción de la clave foránea: $fkName. Contacte al administrador de sistema para más información.", "Producto");
        } else {
            $alerta->add_alerta('danger', "Ocurrió un error inesperado, por favor póngase en contacto con el administrador de sistema.","Producto");
        }
        header('Location: ' . dirname(dirname($_SERVER['PHP_SELF'])). '/index.php?sec=productos&ruta=vistas');
    }
}