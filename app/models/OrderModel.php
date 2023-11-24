<?php
  class OrderModel extends Model {
    public function tableFill() {
      return 'orders';
    }

    public function fieldsFill() {
      return 'id, total, created_at, updated_at, is_purchased, user_id';
    }

    public function getOrder($condition) {
      $sql =
        "SELECT" . 
          " o.id, o.total, o.updated_at, o.is_purchased," . 
          " o.user_id, u.name, u.image, u.email" .
        " FROM orders o" . 
        " JOIN users u" . 
        " ON u.id = o.user_id" . 
        $condition;
      return $this->_db->selectRows($sql); 
    }
  }
?>
