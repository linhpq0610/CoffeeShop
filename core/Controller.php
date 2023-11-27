<?php 
  class Controller {
    protected $_data = [];
    protected $_ROWS_PER_PAGE = 5;

    public function getModel($model) {
      if (file_exists(MODELS_DIR . $model . ".php")) {
        require_once MODELS_DIR . $model . ".php";
        return new $model();
      }
    }

    public function render($viewFile, $data = []) {
      if (file_exists($viewFile . ".php")) {
        extract($data);
        require_once $viewFile . ".php";
      }
    }

    public function isSignedIn() {
      if (isset($_COOKIE['userToken'])) {
        if (!isset($_SESSION['user'])) {
          header("Location: " . AUTO_SIGN_IN_ROUTE);
        }
        return true;
      }
    }

    static public function isAdmin() {
      if (self::isSignedIn()) {
        return $_SESSION['user']['is_admin'];
      }
    }

    public function renderClientLayout($data = []) {
      $this->render(CLIENT_LAYOUT_DIR, $data);
    }

    public function renderAdminLayout($data = []) {
      $this->render(ADMIN_LAYOUT_DIR, $data);
    }

    public function getBtnPagination($currentPage, $NUMBERS_OF_ROW, $route) {
      if ($currentPage > 1) {
        $prevPageBtnRoute = $route . (string)($currentPage - 1);
        $prevPageBtn = 
          "<li class='page-item'><a href='$prevPageBtnRoute' class='page-link'>Prev</a></li>";
      } else {
        $prevPageBtn = 
          "<li class='page-item disabled'><a href='#' class='page-link'>Prev</a></li>";
      }
      
      if ($currentPage < $NUMBERS_OF_ROW) {
        $nextPageBtnRoute = $route . (string)($currentPage + 1);
        $nextPageBtn = 
          "<li class='page-item'><a href='$nextPageBtnRoute' class='page-link'>Next</a></li>";
      } else {
        $nextPageBtn = 
          "<li class='page-item disabled'><a href='#' class='page-link'>Next</a></li>";
      }

      return [$prevPageBtn, $nextPageBtn];
    }

    public function formatNumber($number) {
      return number_format($number, 0, '', ',');
    }

    public function getCurrentPage($currentPage, $NUMBERS_OF_ROW) {
      if ($NUMBERS_OF_ROW == 0 || $currentPage > $NUMBERS_OF_ROW) {
        return 0;
      }

      return $currentPage;
    }

    public function initPagination($currentPage, $wherePhrase, $model) {
      $NUMBERS_OF_ROW = 
        ceil(
          $model->getCountOfRow($wherePhrase) / 
          $this->_ROWS_PER_PAGE
        );

      $numbersOfSkipRow = ($currentPage - 1) * 5;
      $condition = 
        $wherePhrase .
        " LIMIT " . $numbersOfSkipRow . ", " . 
        $this->_ROWS_PER_PAGE;
      $currentPage = $this->getCurrentPage($currentPage, $NUMBERS_OF_ROW);

      return [$currentPage, $NUMBERS_OF_ROW, $condition];
    }

    public function executeAction($action, $params) {
      call_user_func_array([$this, $action], $params);
    }
    
    public function getImageUploaded($data) {
      $imageName = $_FILES['avatar']['name'];
      
      if ($imageName != "") {
        $data["image"] = $imageName;

        move_uploaded_file(
          $_FILES['avatar']['tmp_name'], 
          IMAGES_DIR . "/" . "$imageName"
        );
      }

      return $data;
    }

    public function mergeDataIntoDefault($defaultData, $data) {
      foreach ($data as $key => $value) {
        $defaultData[$key] = $value;
      }
      return $defaultData;
    }
  }
?>
