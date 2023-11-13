<?php 
  class ProductModel extends Model {
    public function tableFill() {
      return 'products';
    }

    public function fieldsFill() {
      return "id, name, price, sale, view, image, description, entered_date, category_id";
    }
    
    public function getCountOfProductOfCategory() {
      $sql =
        "SELECT count(category_id) AS countOfProduct" .
        " FROM " . $this->tableFill() . 
        " GROUP BY category_id";
      return $this->_db->selectRows($sql);
    }

    public function statisticProducts() {
      $sql = 
        "SELECT " . 
          "c.name, count(p.category_id) AS NUMBER_OF_PRODUCTS, " . 
          "AVG(p.price) AS AVG_PRICE, MAX(p.price) AS MAX_PRICE, " . 
          "MIN(p.price) AS MIN_PRICE" .
        " FROM categories c " .
        " JOIN products p " . 
        " ON c.id = p.category_id " .
        " GROUP BY c.name";
      return $this->_db->selectRows($sql);
    }

    public function getDataForProductChart() {
      $sql =
        "SELECT c.name, COUNT(p.category_id) AS NUMBER_OF_PRODUCTS" . 
        " FROM categories c" . 
        " JOIN products p" . 
        " ON p.category_id = c.id" . 
        " GROUP BY c.name";
      return $this->_db->selectRows($sql);
    }
  }
?>