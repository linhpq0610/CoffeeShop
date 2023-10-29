<?php 
  class CategoryModel extends Model {
    public function tableFill() {
      return 'categories';
    }

    public function fieldsFill() {
      return "id, name";
    }
  }
?>