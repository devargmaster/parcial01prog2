<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="mb-4 text-center">Registro</h1>
            <form action="accion/acc_registro.php" method="POST">
                <div class="form-group mb-3">
                    <label for="username">Nombre de Usuario</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="form-group mb-3">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" name="pass" id="pass" required>
                </div>
                <div class="form-group mb-3">
                    <label for="pass2">Repetir Password</label>
                    <input type="password" class="form-control" name="pass2" id="pass2" required>
                </div>
                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                </div>

                <div class="form-group mb-3">
                    <label for="domicilio">Domicilio</label>
                    <input type="text" class="form-control" name="domicilio" id="domicilio" required>
                </div>
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" class="form-control" name="telefono" id="telefono" required>
                </div>
                <div class="form-group mb-3">
                    <label for="codigopostal">Código Postal</label>
                    <input type="text" class="form-control" name="codigopostal" id="codigopostal" required>
                </div>
                <div class="form-group mb-3">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" class="form-control" name="ciudad" id="ciudad" required>
                </div>
                <div class="form-group mb-3">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" required>
                </div>
                <div class="form-group mb-4">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
        </div>
    </div>
</div>
