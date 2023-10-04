<?PHP require_once 'vistas/menunav.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $email = $_POST["email"];
  $telefono = $_POST["telefono"];
  $consulta = $_POST["consulta"];

  echo "<p>Nombre: " . $nombre . "</p>";
  echo "<p>Apellido: " . $apellido . "</p>";
  echo "<p>Email: " . $email . "</p>";
  echo "<p>Teléfono: " . $telefono . "</p>";
  echo "<p>Consulta: " . $consulta . "</p>";
} else {
  echo "No se ha enviado ningún formulario.";
}
?>

