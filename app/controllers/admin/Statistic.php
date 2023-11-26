<?php 
  class Statistic extends Controller {
    private $__productModel;
    private $__commentModel;

    function __construct() {
      $this->__productModel = $this->getModel("ProductModel");
      $this->__commentModel = $this->getModel("CommentModel");
    }

    public function getCondition($currentPage, $wherePhrase) {
      $numbersOfSkipRow = ($currentPage - 1) * 5;
      $condition = 
        $wherePhrase .
        " GROUP BY c.product_id" .
        " LIMIT " . $numbersOfSkipRow . ", " . 
        $this->_ROWS_PER_PAGE;
      return $condition;
    }

    public function showStatisticComments($currentPage, $wherePhrase = ' WHERE p.is_deleted = 0 AND c.is_deleted = 0') {
      $condition = $this->getCondition($currentPage, $wherePhrase);
      [$currentPage, $NUMBERS_OF_ROW] = 
        $this->initPagination($currentPage, $wherePhrase, $this->__commentModel);
      [$prevPageBtn, $nextPageBtn] = 
        $this->getBtnPagination($currentPage, $NUMBERS_OF_ROW, STATISTIC_COMMENT_ROUTE);

      $statisticComments = $this->__commentModel->statisticComments($condition);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/statistics/comment';
      $this->_data['pageTitle'] = 'Thống kê bình luận';
      $this->_data["contentOfPage"] = [
        'statisticComments' => $statisticComments,
        'NUMBERS_OF_ROW' => $NUMBERS_OF_ROW,
        'currentPage' => $currentPage,
        'prevPageBtn' => $prevPageBtn,
        'nextPageBtn' => $nextPageBtn,
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function showComments($productId, $currentPage, $wherePhrase = '') {
      [, , $condition] = 
        $this->initPagination($currentPage, $wherePhrase, $this->__commentModel);

      $NUMBERS_OF_ROW = 
        ceil(
          $this->__commentModel->getCountOfCommentsInProduct($productId, $wherePhrase) / 
          $this->_ROWS_PER_PAGE
        );
      $currentPage = $this->getCurrentPage($currentPage, $NUMBERS_OF_ROW);

      [$prevPageBtn, $nextPageBtn] = 
        $this->getBtnPagination(
          $currentPage,
          $NUMBERS_OF_ROW,
          COMMENTS_ROUTE . $productId . "-trang-"
        );
      
      $condition = ' AND c.is_deleted = 0 ' . $condition;
      $comments = $this->__commentModel->getComments($productId, $condition);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/statistics/commentList';
      $this->_data['pageTitle'] = 'Danh sách bình luận';
      $this->_data["contentOfPage"] = [
        "productId" => $productId,
        "comments" => $comments,
        'NUMBERS_OF_ROW' => $NUMBERS_OF_ROW,
        'currentPage' => $currentPage,
        'prevPageBtn' => $prevPageBtn,
        'nextPageBtn' => $nextPageBtn,
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function showCommentsDeletedInProduct($productId, $currentPage, $wherePhrase = '') {
      [, , $condition] = 
        $this->initPagination($currentPage, $wherePhrase, $this->__commentModel);

      $NUMBERS_OF_ROW = 
        ceil(
          $this->__commentModel->getCountOfCommentsInProduct($productId, $wherePhrase) / 
          $this->_ROWS_PER_PAGE
        );
      $currentPage = $this->getCurrentPage($currentPage, $NUMBERS_OF_ROW);

      [$prevPageBtn, $nextPageBtn] = 
        $this->getBtnPagination(
          $currentPage,
          $NUMBERS_OF_ROW,
          COMMENTS_DELETED_ROUTE . $productId . "-trang-"
        );
      
      $condition = ' AND c.is_deleted = 1 ' . $condition;
      $comments = $this->__commentModel->getComments($productId, $condition);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/statistics/commentsDeletedInProduct';
      $this->_data['pageTitle'] = 'Danh sách bình luận đã xóa';
      $this->_data["contentOfPage"] = [
        "productId" => $productId,
        "comments" => $comments,
        'NUMBERS_OF_ROW' => $NUMBERS_OF_ROW,
        'currentPage' => $currentPage,
        'prevPageBtn' => $prevPageBtn,
        'nextPageBtn' => $nextPageBtn,
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function restore($productId) {
      $data = [
        "is_deleted" => 0,
      ];
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__commentModel->getDB();
      $tableName = $this->__commentModel->tableFill();
      $condition = "product_id = $productId AND id IN ($ids)";
      $DB->update($tableName, $data, $condition);
      header("Location: " . COMMENTS_DELETED_ROUTE . $productId . "-trang-1");
    }
    
    public function hardDelete($productId) {
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__commentModel->getDB();
      $tableName = $this->__commentModel->tableFill();
      $condition = "product_id = $productId AND id IN ($ids)";
      $DB->delete($tableName, $condition);
      header("Location: " . COMMENTS_DELETED_ROUTE . $productId . "-trang-1");
    }

    public function handleActionInCommentsDeleted($productId) {
      if ($_POST['action'] == 'restore') {
        $this->restore($productId);
        die();
      }

      $this->hardDelete($productId);
    }

    public function showProductChart() {
      $dataForProductChart = $this->__productModel->getDataForProductChart();

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/statistics/productChart';
      $this->_data['pageTitle'] = 'Biểu đồ sản phẩm';
      $this->_data["contentOfPage"] = [
        'dataForProductChart' => $dataForProductChart,
      ];
      $this->renderAdminLayout($this->_data); 
    }

    public function showStatisticProducts() {
      $statisticProducts = $this->__productModel->statisticProducts();

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/statistics/product';
      $this->_data['pageTitle'] = 'Thống kê sản phẩm';
      $this->_data["contentOfPage"] = [
        'statisticProducts' => $statisticProducts,
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function searchProducts() {
      $searchMessage = $_POST['search-box'];
      $wherePhrase = 
        " WHERE" . 
          " p.name LIKE '%$searchMessage%' AND" . 
          " p.is_deleted = 0 AND" . 
          " c.is_deleted = 0";
      $this->showStatisticComments(1, $wherePhrase);
    }
    
    public function searchCommentsInProduct($productId) {
      $searchMessage = $_POST['search-box'];
      $wherePhrase = " AND content LIKE '%$searchMessage%'";
      $this->showComments($productId, "1", $wherePhrase);
    }

    public function softDeleteCommentInProduct($productId) {
      $data = [
        "is_deleted" => 1,
      ];
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__commentModel->getDB();
      $tableName = $this->__commentModel->tableFill();
      $condition = "product_id = $productId AND id IN ($ids)";
      $DB->update($tableName, $data, $condition);
      header("Location: " . COMMENTS_ROUTE . $productId . "-trang-1");
    }
  }
?>
