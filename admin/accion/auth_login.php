<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;

$login = (new Autenticacion())->log_in($postData['username'], $postData['pass']);
echo "<pre>";
var_dump($postData);
echo "</pre>";
echo "login:" . $login;

//if ($login) {
//    header('location: ../index.php?sec=home');
//} else {
//    header('location: ../index.php?sec=login2');
//}
