<?php 
  class App {
    private $__router;

    public function __construct($routes) {
      $this->__router = new Router($routes);
      $this->run();
    }

    public function run() {
      $route = $this->__router->matchRoute();
      $controller = $route->getController();
      $action = $route->getAction();
      $params = $route->getParams();
      $controller->executeAction($action, $params);
    }
  }
?>
