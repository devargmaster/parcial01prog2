<?php
$datos_registro = $_POST;
$datos_registro['pass'] = password_hash($datos_registro['pass'], PASSWORD_DEFAULT);
$datos_registro['rol_id'] = 2;
$datos_registro['estado'] = 1;
//echo "<pre>";
//var_dump($datos_registro);
//echo "</pre>";

$usuario = (new Usuario())->insertar();


//header('Location: ../vistas/adm_login.php');
