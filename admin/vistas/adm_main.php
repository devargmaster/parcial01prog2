

<?PHP
if ($_GET['ruta'] == 'acc')
  $path = 'accion/acc_';
else {
  $path = 'vistas/adm_';
}
$archivo = $path . $seccion_elegida_ . '.php';
echo "<pre>";
print_r($archivo);
echo "</pre>";
if (file_exists($archivo)) {
  require_once $path . $seccion_elegida_ . '.php';
} else {
  require_once 'vistas/404.php';
}


?>
