<?php

class Conexion {
  private $host;
  private $dbname;
  private $usuario;
  private $contrasena;
  private $pdo;

  public function __construct($host, $dbname, $usuario, $contrasena) {
    $this->host = $host;
    $this->dbname = $dbname;
    $this->usuario = $usuario;
    $this->contrasena = $contrasena;
  }

  public function conectar() {
    try {
      $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->usuario, $this->contrasena);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Error de conexión: " . $e->getMessage());
    }
  }

  public function ejecutarConsulta($consulta, $parametros = []) {
    $stmt = $this->pdo->prepare($consulta);
    $stmt->execute($parametros);
    return $stmt;
  }


  public function cerrarConexion() {
    $this->pdo = null;
  }
}

?>

