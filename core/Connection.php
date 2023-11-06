<?php 
  class Connection {
    private static $__instance = null, $__conn;

    private function __construct($config) {
      try {
        $dsn = "mysql:dbname=" . $config['DBName'] . ";host=" . $config['host'];
        $options = [
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        self::$__conn = new PDO(
          $dsn,
          $config['userName'],
          $config['password'],
          $options
        );
      } catch (Exception $e) {
        $message = $e->getMessage();
        ErrorHandler::serverError($message);
        die();
      }
    }

    public static function getInstance($config) {
      if (self::$__instance == null) {
        new Connection($config);
        self::$__instance = self::$__conn;
      }

      return self::$__instance;
    }
  }
?>