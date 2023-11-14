<?PHP
require_once '../../functions/autoload.php';
$id = $_GET['id'] ?? FALSE;

$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

if (strpos($currentPath, '/acc/') !== false) {
    $basePath = '../';
}
try {
    $oferta = (new Oferta())->ofertaxId($id);
    $oferta->eliminar();
    header('Location: ' . dirname(dirname($_SERVER['PHP_SELF'])). '/index.php?sec=oferta&ruta=vistas');
} catch (Exception $e) {
    die("No se pudo eliminar la oferta". $e->getMessage());
}
