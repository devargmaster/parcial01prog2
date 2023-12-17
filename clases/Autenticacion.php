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

    public function log_in(string $usuario, string $password): ?bool
    {
        $datosUsuario = (new Usuario())->usuario_x_username($usuario);

        if ($datosUsuario) {
            if (password_verify($password, $datosUsuario->getClave())) {
                $datosLogin['username'] = $datosUsuario->getUsuario();
                $datosLogin['nombre_completo'] = $datosUsuario->getNombre();
                $datosLogin['id'] = $datosUsuario->getId();
                $datosLogin['rol'] = $datosUsuario->getRol();
                $_SESSION['loggedIn'] = $datosLogin;

                return $datosLogin['rol'];
            } else {
                (new Alerta())->add_alerta('danger', "El password ingresado no es correcto.");
                return FALSE;
            }
        } else {
            (new Alerta())->add_alerta('warning', "El usuario ingresado no se encontró en nuestra base de datos.");
            return NULL;
        }
    }

    public function log_out(): void
    {
        if (!headers_sent()) {
            session_destroy();

        }

    }


    public function verify($admin = FALSE): bool
    {

        if (isset($_SESSION['loggedIn'])) {
            if($admin){
                if ($_SESSION['loggedIn']['rol'] == "administrador"){
                    return TRUE;
                }else{
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