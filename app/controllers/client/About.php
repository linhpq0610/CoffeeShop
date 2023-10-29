<?php 
  class About extends Controller {
    public function index() {
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/about';
      $this->_data['pageTitle'] = 'Giới thiệu';
      $this->_data["contentOfPage"] = [];
      $this->renderClientLayout($this->_data);
    }
  }
?>