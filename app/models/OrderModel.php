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

    public function getOrderDetail($id) {
      $sql = 
        "SELECT" . 
          " p.image, p.name, p.description," . 
          " o.price, o.quantity, o.product_id, o.order_id" . 
        " FROM order_detail o" . 
        " JOIN products p" . 
        " ON p.id = o.product_id" . 
        " WHERE o.order_id = $id";
      return $this->_db->selectRows($sql);
    }

    public function getOrderId($userId, $isPurchased) {
      $sql = 
        "SELECT id" . 
        " FROM orders" . 
        " WHERE user_id = $userId AND" . 
        " is_purchased = $isPurchased";
      return $this->_db->getValue($sql);
    }

    public function getTotal($orderId) {
      $sql =
       "SELECT total" . 
       " FROM orders" .
       " WHERE id = $orderId";
      return $this->_db->getValue($sql);
    }

    public function getDatePurchased($orderId) {
      $sql =
       "SELECT updated_at" . 
       " FROM orders" .
       " WHERE id = $orderId";
      return $this->_db->getValue($sql);
    }

    public function updateQuantity($quantity, $condition) {
      $sql = 
        "UPDATE order_detail" . 
        " SET quantity = " . $quantity . 
        " WHERE $condition";
      $this->_db->query($sql);
    }
    
    public function updateTotal($total, $orderId) {
      $sql = 
        "UPDATE orders" . 
        " SET total = " . $total . 
        " WHERE id = $orderId";
      $this->_db->query($sql);
    }

    public function getPrice($orderId, $productId) {
      $sql = 
        "SELECT price" . 
        " FROM order_detail" . 
        " WHERE order_id = $orderId AND product_id = $productId";
      return $this->_db->getValue($sql);
    }
  }
?>
