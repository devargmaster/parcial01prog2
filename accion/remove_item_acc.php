<?PHP
require_once "../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;
$alerta = new Alerta();
if($id){
    (new Carrito())->remove_item($id);
    $alerta->add_alerta('success', "Se elimino tu producto del carrito.", "Carrito");
    header("Location: " . dirname($_SERVER['PHP_SELF'],2) . '/index.php?sec=carrito&ruta=vistas');
}