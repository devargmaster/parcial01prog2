<?PHP
require_once "../../functions/autoload.php";
$alerta = new Alerta();

(new Autenticacion())->log_out();
$alerta->add_alerta('success', "Has cerrado sesión exitosamente.", "Autenticación");

header('location: ../index.php?sec=login');