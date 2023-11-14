<?PHP
require_once '../../functions/autoload.php';
$id = $_GET['id'] ?? FALSE;

$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

if (str_contains($currentPath, '/acc/')) {
    $basePath = '../';
}
try {
    $categoria = (new Categoria())->categoriaxid($id);
    $categoria->eliminar();
    header('Location: ' . dirname(dirname($_SERVER['PHP_SELF'])). '/index.php?sec=categoria&ruta=vistas');
} catch (Exception $e) {
    die("No se pudo eliminar la categoria". $e->getMessage());
}
