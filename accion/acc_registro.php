<?php
require_once "../functions/autoload.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $email = $_POST['email'] ?? '';
    $usuario = $_POST['username'] ?? '';
    $clave = $_POST['pass'] ?? '';
    $clave2 = $_POST['pass2'] ?? '';


    if ($clave !== $clave2) {
        exit('Las contraseñas no coinciden.');
    }


    $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT);


    $usuarioObj = new Usuario();
    $usuarioObj->setNombre($nombre);
    $usuarioObj->setApellido($apellido);
    $usuarioObj->setEmail($email);
    $usuarioObj->setUsuario($usuario);
    $usuarioObj->setClave($claveEncriptada);
    $usuarioObj->setRol('usuario');

    if ($usuarioObj->insertar()) {
        header( "Location: ". dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=exito_registro');
    } else {
        exit('Error al registrar el usuario.');
    }
}
?>
