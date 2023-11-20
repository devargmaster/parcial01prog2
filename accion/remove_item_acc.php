<?PHP
require_once "../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

if($id){
    (new Carrito())->remove_item($id);
    header("Location: " . dirname($_SERVER['PHP_SELF'],2) . '/index.php?sec=carrito&ruta=vistas');
}