<?php

use JetBrains\PhpStorm\NoReturn;

class Autenticacion
{
    private $id;
    private $usuario;
    private $clave;
    private $rol_id;
    private $estado;



    public function __construct()
    {
        $this->id = null;
        $this->usuario = null;
        $this->clave = null;
        $this->rol_id = null;
        $this->estado = null;
    }

    /**
     * verifica si el usuario existe en la base de datos
     *
     * @param $username  -el nombre de usuario
     * @param $clave -la contraseña
     * @return bool|null devuelve true si el usuario existe, false si no existe
     */
    public function log_in($username, $clave): ?bool
    {

        $datosUsuario = (new Usuario())->usuario_x_username($username);

        if ($datosUsuario) {

            echo "<p>El usuario ingresado SI se encontró en nuestra base de datos.</p>";

            if (password_verify($clave, $datosUsuario->getClave())) {
                echo "<p>EL PASSWORD ES CORRECTO! LOGUEAR!</p>";


                $datosLogin['username'] = $datosUsuario->getUsuario();
                $datosLogin['nombre_completo'] = $datosUsuario->getNombre();
                $datosLogin['id'] = $datosUsuario->getId();
                $datosLogin['rol'] = $datosUsuario->getRol();
                $_SESSION['loggedIn'] = $datosLogin;

                return TRUE;
            } else {
                echo "<p>EL PASSWORD NO ES CORRECTO! INTRUSO! >=0</p>";
                return FALSE;
            }
        } else {
            echo "<p>El usuario ingresado no se encontró en nuestra base de datos.</p>";
            return null;
        }
    }

    public function log_out(): void
    {
        if (!headers_sent()) {
            session_destroy();

        }

    }

    public function usuario_x_id($id)
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM usuarios WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                $id
            ]
        );
        return $PDOStatement->fetch(PDO::FETCH_ASSOC);
    }



    public function verify(): bool
    {
        return isset($_SESSION['loggedIn']);
    }

    /**
     * @return null
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param null $estado
     */
    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }
}