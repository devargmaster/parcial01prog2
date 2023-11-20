<?PHP
require_once "../functions/autoload.php";
$postData = $_POST;
if(!empty($postData)){
    (new Carrito())->update_quantities($postData['q']);
    header("Location: " . dirname($_SERVER['PHP_SELF'],2) . '/index.php?sec=carrito&ruta=vistas');
}