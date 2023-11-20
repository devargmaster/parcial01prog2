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
        header( "Location: ". dirname($_SERVER['PHP_SELF'],2) . '/admin/index.php?sec=home&ruta=vistas');
    } else {
        header( "Location: ". dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=home');
    }
} else {
    header('Location: ../vistas/login.php');
}
