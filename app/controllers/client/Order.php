<?php 
  class Order extends Controller {
    private $__orderModel;

    function __construct() {
      $this->__orderModel = $this->getModel('OrderModel');
    }

    public function index() {
      $isPurchased = 0;
      $userId = $_SESSION['user']['id'];
      $orderId = $this->__orderModel->getOrderId($userId, $isPurchased);
      $itemsInOrder = $this->__orderModel->getOrderDetail($orderId);
      
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/cart/cart';
      $this->_data['pageTitle'] = 'Giỏ hàng';
      $this->_data["contentOfPage"] = ['itemsInOrder' => $itemsInOrder];
      $this->renderClientLayout($this->_data);
    }
  }
?>
