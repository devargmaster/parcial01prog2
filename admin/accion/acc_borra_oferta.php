<?PHP
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require_once '../../functions/autoload.php';
$id = $_GET['id'] ?? FALSE;

$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

if (strpos($currentPath, '/acc/') !== false) {
    $basePath = '../';
}
$alerta = new Alerta();
try {
    $oferta = (new Oferta())->ofertaxIdBack($id);
    if ($oferta !== null) {
        $oferta->eliminar();
    } else {
        $alerta->add_alerta('danger', "No se encontró la oferta con el ID proporcionado.", "Oferta");
    }
    $alerta->add_alerta('success', "Oferta eliminada correctamente.", "Oferta");
    header('Location: ' . dirname(dirname($_SERVER['PHP_SELF'])). '/index.php?sec=oferta&ruta=vistas');
} catch (PDOException $e) {
    $alerta = new Alerta();
    if ($e->getCode() == 23000) {
        preg_match('/CONSTRAINT `(.*?)` FOREIGN KEY/', $e->getMessage(), $matches);
        $fkName = $matches[1] ?? '';
        $alerta->add_alerta('danger', "No se puede eliminar debido a la restricción de la clave foránea: $fkName. Contacte al administrador de sistema para más información.", "Producto");
    } else {
        $alerta->add_alerta('danger', "Ocurrió un error inesperado, por favor póngase en contacto con el administrador de sistema.","Oferta");
    }
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=marca&ruta=vistas');
} finally {
    restore_error_handler();
}
