<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;

$login = (new Autenticacion())->log_in($postData['username'], $postData['pass']);

if ($login) {
    // Verificar el rol del usuario
    $rolUsuario = $_SESSION['loggedIn']['rol'];

    // Redirigir según el rol
    if ($rolUsuario == 'administrador') {
        header('Location: ../index.php');
    } else {
        // Redirigir a la página de inicio del cliente
        header('Location: ../../index.php');
    }
} else {
    // Redirigir a la página de inicio de sesión en caso de error
    header('Location: ../vistas/login.php');
}
