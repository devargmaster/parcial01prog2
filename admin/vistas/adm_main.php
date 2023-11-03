

<?PHP

$archivo = 'vistas/adm_' . $seccion_elegida_ . '.php';
if (file_exists($archivo)) {
  require_once 'vistas/adm_' . $seccion_elegida_ . '.php';
} else {
  require_once 'vistas/404.php';
}


?>
