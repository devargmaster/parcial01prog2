<?PHP
require_once "../functions/autoload.php";
$postData = $_POST;
$location = $_GET;

echo "<pre>";
var_dump($postData);
echo "</pre>";

$login = (new Autenticacion())->log_in($postData['username'], $postData['pass']);

if ($login) {
   $rolUsuario = $_SESSION['loggedIn']['rol'];
    if ($rolUsuario == 'administrador') {
        header("Location: " . dirname($_SERVER['PHP_SELF'],2) . '/admin/index.php');
    } else {
        header( "Location: ". dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=home');
    }
} else {
    (new Alerta())->add_alerta('warning', "campos sin completar");
    (new Alerta())->get_alertas();
    header("Location: " . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=login');
}
