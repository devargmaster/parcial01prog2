<?php

class Conexion {
  private const DB_HOST = 'localhost';
  private const DB_NAME = 'decotutti';
  private  const DB_USER ='root';
  private const DB_PASS ='';

  private const DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';

  private static ?PDO $db = null;


  /**
   * Conecta con la base de datos
   *
   * @return void
   */
  public static function conectar(): void
  {
    try {
      self::$db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
    } catch (Exception $e) {
      die('Error al conectar con MySQL.');
    }
  }


  /**
   * Devuelve la conexión a la base de datos
   *
   * @return PDO
   */

  public static function getConexion(): PDO
  {
    if(self::$db === null){
      self::conectar();
    }
    return self::$db;
  }
}



