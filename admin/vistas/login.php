<?php
$auth = new Autenticacion();
$login = $auth->log_in($_POST['username'], $_POST['pass']);
header('location: ../index.php?sec=login');
?>
<div>
    <h1>LOGIN</h1>
    <form action="accion/auth_login.php" method="POST">
        <input type="text" name="username" placeholder="Nombre de usuario">
        <input type="password" name="pass" placeholder="Contraseña">
        <button type="submit">Login</button>
    </form>
</div>
