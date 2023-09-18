<?php
require_once 'clases/Seccion.php';

$seccion = new Seccion();

//echo "<pre>";
//print_r($seccion->secciones_completas());
//echo "</pre>";


// me quedo con la seccion elegida
$seccion_elegida_ =  isset($_GET['sec']) ? $_GET['sec'] : 'home';

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bella Casa Decoracion</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <link href="css/styles.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Bella Casa</a>
    <?PHP
    // armo los links de las secciones habilitadas
    for ($i=0; $i < count($seccion->secciones_completas()); $i++) {
      if ($seccion->secciones_completas()[$i]['habilitada'] == 1) {
        echo "<a href=index.php?sec=" . $seccion->secciones_completas()[$i]['sec'] . " >" . $seccion->secciones_completas()[$i]['nombre'] . "</a> ";
      }
    }
    ?>
  </div>
</nav>
<main>
<?PHP
$archivo ='vistas/'.$seccion_elegida_ .'.php';
if (file_exists($archivo)) {
// armo el path de la vista
  require_once 'vistas/' . $seccion_elegida_ . '.php';
} else {
  require_once 'vistas/404.php';
}
?>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
<footer>

</footer>
</html>
