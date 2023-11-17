<?php

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
     * @return bool devuelve true si el usuario existe, false si no existe
     */
    public function log_in($username, $clave): bool
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM usuarios WHERE usuario = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                $username
            ]
        );
        $usuario = $PDOStatement->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if (password_verify($clave, $usuario['pass'])) {
                $_SESSION['usuario'] = $usuario;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function log_out()
    {
        session_destroy();
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

    public function insertar($username, $pass, $rol_id, $estado)
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO usuarios (usuario, clave, rol_id, estado) VALUES (:username, :pass, :rol_id, :estado)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                ':username' => $username,
                ':pass' => $pass,
                ':rol_id' => $rol_id,
                ':activo' => $estado
            ]
        );
        $this->id = $conexion->lastInsertId();
    }

    public function eliminar()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM usuarios WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                ':id' => $this->id
            ]
        );
    }
}