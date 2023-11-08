<?PHP
require_once '../../functions/autoload.php';
$id = $_GET['id'] ?? FALSE;

$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

if (strpos($currentPath, '/acc/') !== false) {
    $basePath = '../';
}
try {
    $categoria = (new Categoria())->categoriaxid($id);
    $categoria->delete();
    echo $currentPath . '<br>';
    echo $basePath . '<br>';
    echo $basePath . 'index.php?sec=categoria&ruta=vistas';
    header( 'Location: index.php?sec=categorias&ruta=vistas');
} catch (Exception $e) {
    die("No se pudo eliminar la categoria". $e->getMessage());
}
