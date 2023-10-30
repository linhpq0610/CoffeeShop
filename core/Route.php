<?php 
  class Route {
    private $controller;
    private $action;
    private $params;

    public function __construct($controller, $action, $params) {
      $this->controller = $controller;
      $this->action = $action;
      $this->params = $params;
    }

    public function getController() {
      return new $this->controller();
    }

    public function getAction() {
      return $this->action;
    }

    public function getParams() {
      return $this->params;
    }
  }
?>