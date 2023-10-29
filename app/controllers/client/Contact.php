<?php 
  class Contact extends Controller {
    public function index() {
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/contact/contact';
      $this->_data['pageTitle'] = 'Liên hệ';
      $this->_data["contentOfPage"] = [];
      $this->renderClientLayout($this->_data);
    }
  }
?>