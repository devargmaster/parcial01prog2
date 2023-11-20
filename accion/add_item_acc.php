<?PHP
require_once "../functions/autoload.php";
$id = $_GET['id'] ?? FALSE;
$q = $_GET['q'] ?? 1;

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];


if($id){
    (new Carrito())->add_item($id, $q);
    header("Location: " . dirname($_SERVER['PHP_SELF'],2) . '/index.php?sec=carrito&ruta=vistas');
}
