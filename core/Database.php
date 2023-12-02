<?php 
  class Database {
    private $__conn;

    public function __construct() {
      global $config;
      $this->__conn = Connection::getInstance($config['database']);
    }

    function insert($table, $data) {
      if (!empty($data)) {
        $fieldStr = '';
        $valueStr = '';
        foreach ($data as $key => $value) {
          $fieldStr .= $key . ',';
          $valueStr .= "'" . $value . "',";
        }
        $fieldStr = rtrim($fieldStr, ',');
        $valueStr = rtrim($valueStr, ',');

        $sql = "INSERT INTO $table ($fieldStr) VALUES ($valueStr)";
        $this->query($sql);
      }
    }

    function update($table, $data, $condition = '') {
      if (!empty($data)) {
        $updateStr = '';
        foreach ($data as $key => $value) {
          $updateStr .= "$key = '$value', ";
        }

        $updateStr = rtrim($updateStr, ', ');
        if (!empty($condition)) {
          $sql = "UPDATE $table SET $updateStr WHERE $condition";
        } else {
          $sql = "UPDATE $table SET $updateStr";
        }

        $this->query($sql);
      }
    }

    function delete($table, $condition = '') {
      if (!empty($condition)) {
        $sql = "DELETE FROM $table WHERE $condition";
      } else {
        $sql = "DELETE FROM $table";
      }
      $this->query($sql);
    }

    function query($sql) {
      try {
        $statement = $this->__conn->prepare($sql);
        $statement->execute();
        return $statement;
      } catch (Exception $e) {
        $message = $e->getMessage();
        ErrorHandler::serverError($message);
        die();
      }
    }

    function selectRows($sql) {
      $query = $this->query($sql);
      $rows = $query->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    function selectRow($sql) {
      $query = $this->query($sql);
      $rows = $query->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

    function getValue($sql) {
      $query = $this->query($sql);
      return $query->fetchColumn();
    }

    function lastInsertId() {
      return $this->__conn->lastInsertId();
    }
  }
?>