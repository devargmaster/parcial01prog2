<?PHP
require_once '../../functions/autoload.php';
$id = $_GET['id'] ?? FALSE;

$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

if (str_contains($currentPath, '/acc/')) {
    $basePath = '../';
}
try {
    $subcategoria = (new Subcategoria())->subcategoriaxid($id);
    $subcategoria->eliminar();
    header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=subcategoria&ruta=vistas');
} catch (Exception $e) {
    die("No se pudo eliminar la Subcategoria". $e->getMessage());
}
