<?PHP
require_once "../functions/autoload.php";
$postData = $_POST;
$alerta = new Alerta();

if(!empty($postData)){
    (new Carrito())->update_quantities($postData['q']);
    $alerta->add_alerta('success', "Los items se han actualizado correctamente.", "Carrito");
    header("Location: " . dirname($_SERVER['PHP_SELF'],2) . '/index.php?sec=carrito&ruta=vistas');
}