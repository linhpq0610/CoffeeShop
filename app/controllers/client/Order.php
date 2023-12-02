<?php 
  class Order extends Controller {
    private $__orderModel;

    function __construct() {
      $this->__orderModel = $this->getModel('OrderModel');
    }

    public function index() {
      if ($this->isSignedIn()) {
        $isPurchased = 0;
        $userId = $_SESSION['user']['id'];
        $orderId = $this->__orderModel->getOrderId($userId, $isPurchased);
        $itemsInOrder = $this->__orderModel->getOrderDetail($orderId);
        $total = $this->__orderModel->getTotal($orderId);
      }
      
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/cart/cart';
      $this->_data['pageTitle'] = 'Giỏ hàng';
      $this->_data['contentOfPage'] = [
        'itemsInOrder' => $itemsInOrder ?? [],
        'total' => $total ?? 0,
      ];
      $this->renderClientLayout($this->_data);
    }
  }
?>
