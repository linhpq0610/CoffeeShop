<?php 
  abstract class Model extends Database {
    protected $_db;
    protected $_tableName;
    protected $_fieldsSelected;

    function __construct() {
      $this->_db = new Database();
      $this->_tableName = $this->tableFill();
      $this->_fieldsSelected = $this->fieldsFill();
    }

    abstract function tableFill();
    abstract function fieldsFill();

    public function getDB() {
      return $this->_db;
    }
    
    public function selectAllRows() {
      $sql = 
        "SELECT ". $this->_fieldsSelected . 
        " FROM " . $this->_tableName;
      return $this->_db->selectRows($sql);
    }

    public function selectOneRowById($id) {
      $sql = 
        "SELECT " . $this->_fieldsSelected . 
        " FROM " . $this->_tableName . 
        " WHERE id = $id";
      return $this->_db->selectRow($sql);
    }

    public function isAdmin() {
      $sql = 
        "SELECT `role`" .
        " FROM " . $this->_tableName .
        " WHERE id = " . $_COOKIE[COOKIE_LOGIN_NAME];
      $customer = $this->_db->selectRow($sql);
      return $customer['role']; 
    }
    
    public function getCountOfRow($wherePhrase = '') {
      $sql = 
        "SELECT count(*) AS NUMBERS_OF_ROW" .
        " FROM " . $this->_tableName . $wherePhrase;
      $NUMBERS_OF_ROW = $this->_db->selectRow($sql)['NUMBERS_OF_ROW'];
      return $NUMBERS_OF_ROW;
    }
    
    public function selectRowsByData($condition) {
      $sql = 
        "SELECT " . $this->_fieldsSelected .
        " FROM " . $this->_tableName . $condition;
      return $this->_db->selectRows($sql);
    }
  }
?>