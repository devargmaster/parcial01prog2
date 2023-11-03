

<?PHP

$archivo = 'vistas/' . $seccion_elegida_ . '.php';
if (file_exists($archivo)) {
  require_once 'vistas/' . $seccion_elegida_ . '.php';
} else {
  require_once 'vistas/404.php';
}


?>
