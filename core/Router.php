<?php 
  class Router {
    private $routes;

    public function __construct($routes) {
      $this->routes = $routes;
    }

    public function handleController($urlSegments) {
      $currenPath = '';
      $controller = "Home";

      foreach ($urlSegments as $index => $value) {
        $currenPath .= $value . '/';
        $controllerPath = rtrim($currenPath, '/');

        $controllerSegments = explode('/', $controllerPath);
        $LAST_CONTROLLER_SEGMENT_INDEX = count($controllerSegments) - 1;
        $controllerSegments[$LAST_CONTROLLER_SEGMENT_INDEX] = 
          ucfirst($controllerSegments[$LAST_CONTROLLER_SEGMENT_INDEX]);
        $controllerPath = implode('/', $controllerSegments);

        if (file_exists(CONTROLLERS_DIR . $controllerPath . ".php")) {
          require_once CONTROLLERS_DIR . $controllerPath . ".php";
          $controller = ucfirst($controllerSegments[$LAST_CONTROLLER_SEGMENT_INDEX]);
          break;
        }
      }

      return $controller;
    }

    public function handleAction($urlSegments) {
      $ACTION_INDEX = 2;
      $action = 'index';
      if (!empty($urlSegments[$ACTION_INDEX])) {
        $action = $urlSegments[$ACTION_INDEX];
      }
      return $action;
    }

    public function handleParams($urlSegments) {
      $FIRST_PARAM_INDEX = 3;
      $params = array_slice($urlSegments, $FIRST_PARAM_INDEX);
      return $params;
    }

    public function handleUrl($url) {
      $urlSegments = array_filter(explode("/", $url));
      $urlSegments = array_values($urlSegments);

      $controller = $this->handleController($urlSegments);
      $action = $this->handleAction($urlSegments);
      $params = $this->handleParams($urlSegments);

      return new Route($controller, $action, $params);
    }

    public function matchRoute() {
      $url = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : HOME_ROUTE;

      foreach ($this->routes as $urlOfRoute => $route) {
        if (preg_match("~$urlOfRoute~is", $url)) {
          $url = preg_replace("~$urlOfRoute~is", $route, $url);
          return $this->handleUrl($url);
        }
      }

      ErrorHandler::notFound();
    }
  }
?>
