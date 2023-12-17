<?PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../functions/autoload.php";
$postData = $_POST;

echo "<pre>";
print_r($postData);
echo "</pre>";

$login = (new Autenticacion())->log_in($postData['username'], $postData['password']);
echo "<pre>";
print_r($login);
echo "</pre>";
if ($login === true) {
    $rolUsuario = $_SESSION['loggedIn']['rol'];
    if ($rolUsuario == 'administrador') {
        header("Location: " . dirname($_SERVER['PHP_SELF'],2) . '/admin/index.php');
    } else {
        header( "Location: ". dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=home');
    }
} else {
    if ($login === 'usuario_incorrecto') {
        (new Alerta())->add_alerta('warning', "Usuario incorrecto");
    } elseif ($login === 'clave_incorrecta') {
        (new Alerta())->add_alerta('warning', "Contraseña incorrecta");
    }
    elseif ($login === 'no_existe') {
        (new Alerta())->add_alerta('warning', "Verificar usuario y contraseña");
    }
    //header("Location: " . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=login');
}