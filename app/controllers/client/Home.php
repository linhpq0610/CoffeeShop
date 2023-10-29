<?php 
  class Home extends Controller {
    private $__homeModel;

    function __construct() {
      $this->__homeModel = $this->getModel("HomeModel");
    }

    public function index() {
      $popularProducts = $this->__homeModel->get4PopularProducts();
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/home';
      $this->_data['contentOfPage'] = ["popularProducts" => $popularProducts];
      $this->renderClientLayout($this->_data);
    }
  }
?>