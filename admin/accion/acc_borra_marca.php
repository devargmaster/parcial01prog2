<?PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../functions/autoload.php';
$id = $_GET['id'] ?? FALSE;

$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

if (str_contains($currentPath, '/acc/')) {
    $basePath = '../';
}
$alerta = new Alerta();

try {

    $marca = (new Marca())->marcaxid($id);
    $marca->eliminar();
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=marca&ruta=vistas');
} catch (Exception $e) {
    $alerta = new Alerta();
    $message = $e->getMessage();
    if (preg_match('/CONSTRAINT `(.*?)` FOREIGN KEY/', $message, $matches)) {
        $fkName = $matches[1];
        $alerta->add_alerta('danger', "No se puede eliminar debido a la restricción de la clave foránea: $fkName contacte al administrador de sistema, para mas información.", "Marca");
    } else {
        $alerta->add_alerta('danger', "Ocurrió un error inesperado, por favor pongase en contacto con el administrador de sistema.","Marca");
    }
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=marca&ruta=vistas');
} finally {
    restore_error_handler();
}
