<?PHP
require_once "../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;
$q = $_GET['q'] ?? 1;


if($id){
    $carrito = new Carrito();
    if (!isset($_SESSION['carritoGUID'])) {
        $carrito->create_cart();
    }
    $carrito->add_item($id, $q);
    header('location: ../index.php?sec=carrito');
}