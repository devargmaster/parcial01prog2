<?PHP
if (isset($_GET['sec'])) {
  $seccion_elegida_ = $_GET['sec'];
} else {
  $seccion_elegida_ = 'home';
}
if (isset($_GET['ruta'])) {
  if ($_GET['ruta'] == 'acc')
    $path = 'accion/acc_';
  else {
    $path = 'vistas/adm_';
  }
} else {
  $path = 'vistas/adm_';
}

$archivo = $path . $seccion_elegida_ . '.php';
//echo "<pre>";
//print_r($archivo);
//echo "</pre>";
if (file_exists($archivo)) {
  require_once $path . $seccion_elegida_ . '.php';
} else {
  require_once 'vistas/404.php';
}


?>
