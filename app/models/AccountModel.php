<?php 
  class AccountModel extends Model {
    private $__customer;

    public function tableFill() {
      return 'customers';
    }

    public function fieldsFill() {
      return "id, name, image, email, active, role, password";
    }

    public function getCustomer() {
      return $this->__customer;
    }

    public function selectCustomerByData($condition) {
      $sql = 
        "SELECT " . $this->_fieldsSelected .
        " FROM " . $this->_tableName . 
        $condition;
      $this->__customer = $this->_db->selectRow($sql);
    }

    public function selectCustomersByData($condition) {
      $sql = 
        "SELECT " . $this->_fieldsSelected .
        " FROM " . $this->_tableName . $condition;
      return $this->_db->selectRows($sql);
    }

    public function hasCustomer($data, $logicOperator) {
      $condition = $this->getConditionQuery($data, $logicOperator);
      $this->selectCustomerByData($condition);
      return $this->__customer != [] ? true : false;
    }

    public function getConditionQuery($data, $logicOperator) {
      $condition = " WHERE ";
      foreach ($data as $column => $value) {
        $condition .= "$column = '$value' $logicOperator ";
      }
      $condition = rtrim($condition, $logicOperator . ' ');
      return $condition;
    }
  }
?>