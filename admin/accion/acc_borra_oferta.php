<?PHP
require_once '../../functions/autoload.php';
$id = $_GET['id'] ?? FALSE;

$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

if (strpos($currentPath, '/acc/') !== false) {
    $basePath = '../';
}
$alerta = new Alerta();
try {
    $oferta = (new Oferta())->ofertaxId($id);
    $oferta->eliminar();
    header('Location: ' . dirname(dirname($_SERVER['PHP_SELF'])). '/index.php?sec=oferta&ruta=vistas');
} catch (PDOException $e) {
    error_log("Error al eliminar la oferta: " . $e->getMessage());
    $alerta->add_alerta('danger', "Ocurrió un error al intentar eliminar la oferta. Por favor, inténtalo de nuevo más tarde.", "Oferta");
}
