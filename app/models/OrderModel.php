<?php
  class ProductModel extends Model {
    public function tableFill() {
      return 'orders';
    }

    public function fieldsFill() {
      return 'total, updated_at, is_purchased, user_id';
    }
  }
?>
