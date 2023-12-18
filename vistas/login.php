
<div class="row my-5 justify-content-center">
    <div class="col col-md-5">

        <h1 class="text-center mb-5 fw-bold">Iniciar Sessión</h1>

        <div>

            <?php
            echo (new Alerta())->get_alertas();
            $auth = new Autenticacion();
            if ($auth->verify()) {
                (new Alerta())->add_alerta('warning', "Ya estás logueado, podes seguir comprando.", "Login");
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
                <label for="password" class="form-label">Clave</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
<a href="index.php?sec=registro">Registrarse</a>

    </div>
</div>
