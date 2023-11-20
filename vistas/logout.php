<?PHP
require_once "../../functions/autoload.php";


(new Autenticacion())->log_out();
header('location: ../index.php?sec=login');
