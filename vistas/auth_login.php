<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$location = $_GET;


$login = (new Autenticacion())->log_in($postData['username'], $postData['pass']);
if ($login) {
    // Verificar el rol del usuario
    $rolUsuario = $_SESSION['loggedIn']['rol'];


    if ($rolUsuario == 'administrador') {
        header('Location: ../index.php');
    } else {
        header( 'Location: ../../index.php?sec=home');
    }
} else {
    header('Location: ../vistas/login.php');
}
