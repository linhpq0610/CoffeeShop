<?php 
  class Dashboard extends Controller {
    public function index() {
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/dashboard';
      $this->_data["contentOfPage"] = [];
      $this->renderAdminLayout($this->_data);
    }
  }
?>