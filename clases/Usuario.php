<?php

class Usuario
{
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $usuario;
    private $rol;
    private $estado;

    public function __construct()
    {
    }

    public function usuarios_completos(): array
    {
        $conexion = Conexion::getConexion();
        $consulta = "SELECT * FROM usuarios";
        $PDOStatement =  $conexion->prepare($consulta);
        $PDOStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll();
    }
  public function usuario_x_username(string $username): ?Usuario
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM usuarios WHERE usuario = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$username]);

        $result = $PDOStatement->fetch();

        if (!$result) {
            return null;
        }
        return $result;
    }

    public function insertar() {
        $conexion = Conexion::getConexion();
        $consulta = "INSERT INTO usuarios (nombre, apellido, email, clave, estado, rol) VALUES (:nombre, :apellido, :email, :clave, :estado, :rol)";

        $sentencia = $conexion->prepare($consulta);

        $resultado = $sentencia->execute(
            [
                ':nombre' => $this->nombre,
                ':apellido' => $this->apellido,
                ':email' => $this->email,
                ':password' => $this->clave,
                ':habilitado' => $this->habilitado,
                ':rol' => $this->rol
            ]
        );

        if($resultado) {
            $this->id = $conexion->lastInsertId();
        }

        return $resultado;
    }

    public function eliminar(): void
    {
        $conexion = Conexion::getConexion();
        $consulta = "DELETE FROM usuarios WHERE id = :id";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute(
            [
                ':id' => $this->id
            ]
        );
    }
    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido): void
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario): void
    {
        $this->usuario = $usuario;
    }
    private $clave;

    /**
     * @return mixed
     */
    public function getClave(): mixed
    {
        return $this->clave;
    }

    /**
     * @param mixed $clave
     */
    public function setClave($clave): void
    {
        $this->clave = $clave;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol): void
    {
        $this->rol = $rol;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }
}
