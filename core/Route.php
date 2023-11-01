<?php 
  class Route {
    private $__controller;
    private $__action;
    private $__params;

    public function __construct($controller, $action, $params) {
      $this->__controller = $controller;
      $this->__action = $action;
      $this->__params = $params;
    }

    public function getController() {
      return new $this->__controller();
    }

    public function getAction() {
      return $this->__action;
    }

    public function getParams() {
      return $this->__params;
    }
  }
?>
