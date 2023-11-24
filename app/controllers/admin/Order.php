<?php
  class Order extends Controller {
    private $__orderModel;

    function __construct() {
      $this->__orderModel = $this->getModel('OrderModel');
    }

    public function index($currentPage, $wherePhrase = " WHERE is_deleted = 0") {
      [$currentPage, $NUMBERS_OF_ROW, $condition] = 
        $this->initPagination($currentPage, $wherePhrase, $this->__orderModel);
      [$prevPageBtn, $nextPageBtn] = 
        $this->getBtnPagination($currentPage, $NUMBERS_OF_ROW, ADMIN_PRODUCT_ROUTE);
      $pos = strpos($condition, 'is_deleted');
      $condition = substr($condition, 0, $pos) . 'o.' . substr($condition, $pos);
      $orders = $this->__orderModel->getOrder($condition);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/orders/list';
      $this->_data['pageTitle'] = 'Danh sách đơn hàng';
      $this->_data["contentOfPage"] = [
        'orders' => $orders,
        'NUMBERS_OF_ROW' => $NUMBERS_OF_ROW,
        'currentPage' => $currentPage,
        'prevPageBtn' => $prevPageBtn,
        'nextPageBtn' => $nextPageBtn,
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function searchOrdersByTotalAndDate() {
      $searchMessage = $_POST['search-box'];
      $wherePhrase = 
        " WHERE" . 
          " total LIKE '%$searchMessage%' OR " . 
          " created_at LIKE '%$searchMessage%' OR" . 
          " updated_at LIKE '%$searchMessage%' AND" .
          " is_deleted = 0";
      $this->index(1, $wherePhrase);
    }
  }
?>
