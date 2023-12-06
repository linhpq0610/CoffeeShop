<?php 
  class HomeModel extends Model {
    public function tableFill() {
      return "products";
    }

    public function fieldsFill() {
      return "id, name, price, image, view, sale";
    }

    public function get4PopularProducts() {
      $sql = 
        "SELECT " . ($this->fieldsFill()) . 
        " FROM " . ($this->tableFill()) . 
        " WHERE is_deleted = 0 AND view > 0" . 
        " ORDER BY view DESC LIMIT 4";
      $popularProducts = $this->_db->selectRows($sql);
      return $popularProducts;
    }
  }
?>