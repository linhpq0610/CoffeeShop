<?php 
  class Cart extends Controller {
    public function index() {
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/cart/cart';
      $this->_data["contentOfPage"] = [];
      $this->renderClientLayout($this->_data);
    }
  }
?>