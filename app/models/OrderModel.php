<?php
  class OrderModel extends Model {
    public function tableFill() {
      return 'orders';
    }

    public function fieldsFill() {
      return 'id, total, created_at, updated_at, is_purchased, user_id';
    }
  }
?>
