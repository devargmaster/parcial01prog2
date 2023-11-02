<?php

class Conexion {
  private const DB_HOST = 'localhost';
  private const DB_NAME = 'decotutti';
  private  const DB_USER ='root';
  private const DB_PASS ='Nvidia2022';

  private const DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';

  private static ?PDO $db = null;


//  public function __construct() {
//    try {
//      $this->db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
//      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    } catch (PDOException $e) {
//      die("Error de conexión: " . $e->getMessage());
//    }
//
//  }

  public static function getConexion(): PDO
  {
    if(self::$db === null){
      self::conectar();
    }
    return self::$db;
  }
  public static function conectar(): void
  {
    try {
      self::$db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
    } catch (Exception $e) {
      die('Error al conectar con MySQL.');
    }
  }

public function  ejecutarConsultaObjeto($consulta, $parametros = array()){
  $stmt = $this->getConexion()->prepare($consulta);
  $stmt->execute($parametros);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}

?>

