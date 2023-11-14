<?PHP
require_once '../../functions/autoload.php';
$id = $_GET['id'] ?? FALSE;

$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

if (str_contains($currentPath, '/acc/')) {
    $basePath = '../';
}
try {
    $marca = (new Marca())->marcaxid($id);
    $marca->eliminar();
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=marca&ruta=vistas');
} catch (Exception $e) {
    die("No se pudo eliminar la Marca". $e->getMessage());
}
