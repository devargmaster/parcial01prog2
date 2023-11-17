<?php

?>
<div>
    <h1>Registro</h1>
    <form action="../accion/registro.php" method="POST">
        <div>
            <label for="username">Nombre de Usuario</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass">
        </div>
        <div>
            <label for="pass2">Repetir Password</label>
            <input type="password" name="pass2" id="pass2">
        </div>
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <div>
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
</div>
