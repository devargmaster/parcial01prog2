
<div class="row my-5 justify-content-center">
    <div class="col col-md-5">

        <h1 class="text-center mb-5 fw-bold">Iniciar Sessión</h1>

        <div>

            <?php
            $auth = new Autenticacion();
            if ($auth->verify()) {
                (new Alerta())->add_alerta('warning', "Ya estás logueado, podes seguir comprando.");
                (new Alerta())->get_alertas();
            }
            ?>
        </div>
        <form class="row g-3" action="accion/auth_login.php" method="POST">
            <div class="col-12 mb-3">
                <label for="username" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>

            <div class="col-12 mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
<a href="vistas/registro.php">Registrarse</a>

    </div>
</div>
