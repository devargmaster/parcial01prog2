<?PHP
require_once "../../functions/autoload.php";


(new Carrito())->clear_items();
header('location: ../../index.php?sec=carrito');
