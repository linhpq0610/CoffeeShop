<?php 
  class CategoryModel extends Model {
    public function tableFill() {
      return 'categories';
    }

    public function fieldsFill() {
      return "id, name";
    }

    public function getCategories() {
      $sql = 
        "SELECT c.id, c.name, COUNT(p.category_id) AS countOfProduct" . 
        " FROM categories c" . 
        " JOIN products p" . 
        " ON c.id = p.category_id" . 
        " WHERE p.is_deleted = 0 AND c.is_deleted = 0" . 
        " GROUP BY c.id, c.name" .
        " HAVING countOfProduct > 0";
      return $this->_db->selectRows($sql);
    }
  }
?>