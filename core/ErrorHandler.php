<?php 
  class ErrorHandler {
    static public function notFound() {
      require_once ERRORS_DIR . "404.php";
    }

    static public function serverError($message) {
      require_once ERRORS_DIR . "500.php";
    }

    static public function isNotAdmin() {
      require_once ERRORS_DIR . "isNotAdmin.php";
    }

    static public function isNotSignedIn() {
      require_once ERRORS_DIR . "isNotSignedIn.php";
    }
    
    static public function mailCanNotSend($error) {
      require_once ERRORS_DIR . "mailCanNotSend.php";
    }
  }
?>