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
            if (password_verify($clave, $datosUsuario->getClave())) {
                $datosLogin['username'] = $datosUsuario->getUsuario();
                $datosLogin['nombre_completo'] = $datosUsuario->getNombre();
                $datosLogin['id'] = $datosUsuario->getId();
                $datosLogin['rol'] = $datosUsuario->getRol();
                $_SESSION['loggedIn'] = $datosLogin;
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
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



    public function verify($admin = FALSE): bool
    {

        if (isset($_SESSION['loggedIn'])) {
            if($admin){
                if ($_SESSION['loggedIn']['rol'] == "administrador"){
                    return TRUE;
                }else{
                    (new Alerta())->add_alerta('warning', "El usuario no tiene permisos para ingresar a este area");
                    header("Location: " . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=login');
                }
            }else{
                return TRUE;
            }
        }
        return FALSE;
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