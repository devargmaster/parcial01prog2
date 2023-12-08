<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body">

        <form class="row g-3" action="../accion/auth_login.php" method="POST">
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
        <a href="adm_registro.php">Registrarse</a>

                </div>
            </div>
        </div>
    </div>
</div>