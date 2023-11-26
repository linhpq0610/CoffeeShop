<?php 
  class CommentModel extends Model {
    public function tableFill() {
      return 'comments';
    }

    public function fieldsFill() {
      return "id, content, product_id, user_id, commented_date";
    }

    public function getComments($productId, $condition = '') {
      $sql = 
        "SELECT c.*, u.name user_name, u.image, u.email" .
        " FROM comments c" .
        " JOIN users u" .
        " ON u.id = c.user_id" .
        " WHERE c.product_id = $productId" . 
        $condition;
      return $this->_db->selectRows($sql);
    }

    public function statisticComments($condition) {
      $sql = 
        "SELECT " . 
          "p.id, p.name, c.product_id, COUNT(c.id) as countOfComment, " . 
          "COUNT(c.product_id) AS NUMBERS_OF_COMMENT, " .
          "MAX(c.commented_date) AS NEWEST_DATE, " . 
          "MIN(c.commented_date) AS OLDEST_DATE" .
        " FROM comments c " .
        " JOIN products p " . 
        " ON c.product_id = p.id " .
        $condition;
      return $this->_db->selectRows($sql);
    }
    
    public function getCountOfRow($wherePhrase = '') {
      $sql = 
        "SELECT COUNT(*) AS NUMBERS_OF_ROW" .
        " FROM (" .
          "SELECT c.product_id" .
          " FROM comments c" .
          " JOIN products p ON c.product_id = p.id" .
          $wherePhrase .
          " GROUP BY c.product_id" .
        ") AS sub_query";
      
      $NUMBERS_OF_ROW = $this->_db->selectRow($sql)['NUMBERS_OF_ROW'];
      return $NUMBERS_OF_ROW;
    }

    public function getCountOfCommentsInProduct($id, $condition) {
      $sql = 
        "SELECT COUNT(*) AS NUMBERS_OF_ROW" . 
        " FROM comments" . 
        " WHERE product_id = $id" . 
        $condition;
      
      $NUMBERS_OF_ROW = $this->_db->selectRow($sql)['NUMBERS_OF_ROW'];
      return $NUMBERS_OF_ROW;
    }
  }
?>
