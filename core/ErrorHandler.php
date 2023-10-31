<?php 
  class ErrorHandler {
    static public function notFound() {
      require_once ERRORS_DIR . "404.php";
    }

    static public function serverError($message) {
      require_once ERRORS_DIR . "500.php";
    }
  }
?>