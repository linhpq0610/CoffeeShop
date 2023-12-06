<?php 
  class Order extends Controller {
    private $__orderModel;

    function __construct() {
      $this->__orderModel = $this->getModel('OrderModel');
      if (!$this->isSignedIn()) {
        header("Location: " . FORM_SIGN_IN_ROUTE);
      }
    }

    public function index() {
      $isPurchased = 0;
      $userId = $_SESSION['user']['id'];
      $orderId = $this->__orderModel->getOrderId($userId, $isPurchased);
      $orderId = $orderId != '' ? $orderId : 0;
      $itemsInOrder = $this->__orderModel->getOrderDetail($orderId);
      $total = $this->__orderModel->getTotal($orderId);
      
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/cart/cart';
      $this->_data['pageTitle'] = 'Giỏ hàng';
      $this->_data['contentOfPage'] = [
        'itemsInOrder' => $itemsInOrder,
        'total' => $total,
      ];
      $this->renderClientLayout($this->_data);
    }

    public function showBills() {
      $userId = $_SESSION['user']['id'];
      $condition = " WHERE is_purchased = 1 AND user_id = $userId";
      $bills = $this->__orderModel->selectRowsBy($condition);

      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/cart/bills';
      $this->_data['pageTitle'] = 'Hóa đơn';
      $this->_data['contentOfPage'] = [
        'bills' => $bills,
      ];    
      $this->renderClientLayout($this->_data);
    }

    public function showBillDetail($id) {
      $itemsInOrder = $this->__orderModel->getOrderDetail($id);
      $total = $this->__orderModel->getTotal($id);
      $datePurchased = $this->__orderModel->getDatePurchased($id);

      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/cart/detailBill';
      $this->_data['pageTitle'] = 'Chi tiết hóa đơn';
      $this->_data['contentOfPage'] = [
        'itemsInOrder' => $itemsInOrder,
        'total' => $total,
        'datePurchased' => $datePurchased,
      ];    
      $this->renderClientLayout($this->_data);
    }
  }
?>
