<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Decora Tutti Decoracion</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link href="css/estilos_generales.css" rel="stylesheet">
</head>
<body>
<?PHP require_once 'vistas/menunav.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $email = $_POST["email"];
  $telefono = $_POST["telefono"];
  $consulta = $_POST["consulta"];

  echo "<p>Nombre: " . $nombre. "</p>";
  echo "<p>Apellido: " . $apellido. "</p>";
  echo "<p>Email: " .$email. "</p>";
  echo "<p>Teléfono: " .$telefono. "</p>";
  echo "<p>Consulta: " .$consulta. "</p>";
} else {
  echo "No se ha enviado ningún formulario.";
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<?PHP require_once 'vistas/footer.php'; ?>
</body>
</html>

