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
        $this->getBtnPagination($currentPage, $NUMBERS_OF_ROW, ORDERS_ROUTE);
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

    public function showOrdersDeleted($currentPage, $wherePhrase = " WHERE is_deleted = 1") {
      [$currentPage, $NUMBERS_OF_ROW, $condition] = 
        $this->initPagination($currentPage, $wherePhrase, $this->__orderModel);
      [$prevPageBtn, $nextPageBtn] = 
        $this->getBtnPagination($currentPage, $NUMBERS_OF_ROW, ORDERS_ROUTE);
      $pos = strpos($condition, 'is_deleted');
      $condition = substr($condition, 0, $pos) . 'o.' . substr($condition, $pos);
      $orders = $this->__orderModel->getOrder($condition);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/orders/ordersDeleted';
      $this->_data['pageTitle'] = 'Danh sách đơn hàng đã xóa';
      $this->_data["contentOfPage"] = [
        'orders' => $orders,
        'NUMBERS_OF_ROW' => $NUMBERS_OF_ROW,
        'currentPage' => $currentPage,
        'prevPageBtn' => $prevPageBtn,
        'nextPageBtn' => $nextPageBtn,
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function detail($id, $currentPage, $wherePhrase = '') {
      $ordersDetail = $this->__orderModel->getOrderDetail($id);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/orders/detail';
      $this->_data['pageTitle'] = 'Chi tiết đơn hàng';
      $this->_data["contentOfPage"] = [
        'ordersDetail' => $ordersDetail,
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

    public function softDelete() {
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      $data = [
        "is_deleted" => 1,
        "updated_at" => '' . date('Y-m-d H:i:s'),
      ];
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__orderModel->getDB();
      $tableName = $this->__orderModel->tableFill();
      $condition = "id IN ($ids)";
      $DB->update($tableName, $data, $condition);
      header("Location: " . ORDERS_ROUTE . "1");
    }

    public function restore() {
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      $data = [
        "is_deleted" => 0,
        "updated_at" => '' . date('Y-m-d H:i:s'),
      ];
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__orderModel->getDB();
      $tableName = $this->__orderModel->tableFill();
      $condition = "id IN ($ids)";
      $DB->update($tableName, $data, $condition);
      header("Location: " . ORDERS_DELETED_ROUTE . "1");
    }
    
    public function hardDelete() {
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__orderModel->getDB();
      $tableName = $this->__orderModel->tableFill();
      $condition = "id IN ($ids)";
      $DB->delete($tableName, $condition);
      header("Location: " . ORDERS_DELETED_ROUTE . "1");
    }

    public function handleActionInOrdersDeleted() {
      if ($_POST['action'] == 'restore') {
        $this->restore();
        die();
      }

      $this->hardDelete();
    }
  }
?>
