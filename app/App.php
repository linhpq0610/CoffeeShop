<?php 
  class App {
    private $__controller, $__action, $__params, $__routes;
    public static $app;

    function __construct() {
      global $routes, $config;
      self::$app = $this;
      $this->__routes = new Route();
      if (!empty($routes['default_route'])) {
        $this->__controller = $routes['default_route'];
      }
      $this->__action = "index";
      $this->__params = [];
      $this->handleUrl();
    }

    public function getUrl() {
      if (!empty($_SERVER['PATH_INFO'])) {
        $url = $_SERVER['PATH_INFO'];
      } else {
        $url = HOME_ROUTE;
      }

      return $url;
    }

    public function loadError($name = "404", $data = []) {
      extract($data);
      require_once ERRORS_DIR . $name . ".php";
    }

    public function handleUrl() {
      $url = $this->getUrl();
      $url = $this->__routes->handleRoute($url);
      $urlArr = array_filter(explode("/", $url));
      $urlArr = array_values($urlArr);

      $urlCheck = '';
      if (!empty($urlArr)) {
        foreach ($urlArr as $key => $item) {
          $urlCheck .= $item . '/';
          $fileCheck = rtrim($urlCheck, '/');
          $fileArr = explode('/', $fileCheck);
          $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
          $fileCheck = implode('/', $fileArr);

          if (!empty($urlArr[$key - 1])) {
            unset($urlArr[$key - 1]);
          }

          if (file_exists(CONTROLLERS_DIR . $fileCheck . ".php")) {
            $urlCheck = $fileCheck;
            break;
          }
        }
      }
      $urlArr = array_values($urlArr);

      if (!empty($urlArr[0])) {
        $this->__controller = ucfirst($urlArr[0]);
      } else {
        $this->__controller = "Home";
      }

      if (file_exists(CONTROLLERS_DIR . $urlCheck . ".php")) {
        require_once CONTROLLERS_DIR . $urlCheck . ".php";
        if (class_exists($this->__controller)) {
          $this->__controller = new $this->__controller();
          unset($urlArr[0]);
        }
      } else {
        $this->loadError();
      }
      
      if (!empty($urlArr[1])) {
        $this->__action = $urlArr[1];
        unset($urlArr[1]);
      }
    
      $this->__params = array_values($urlArr);
      if (method_exists($this->__controller, $this->__action)) {
        call_user_func_array([$this->__controller, $this->__action], $this->__params);
      }
    }
  }
?>