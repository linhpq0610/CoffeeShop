<?php 
  class App {
    private $router;
    public static $app;

    public function __construct($routes) {
      self::$app = $this;
      $this->router = new Router($routes);
      $this->run();
    }

    public function run() {
      $route = $this->router->matchRoute();
      $controller = $route->getController();
      $action = $route->getAction();
      $params = $route->getParams();
      $controller->executeAction($action, $params);
    }
  }
?>
