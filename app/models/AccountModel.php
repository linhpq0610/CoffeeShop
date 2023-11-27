<?php 
  class AccountModel extends Model {
    public function tableFill() {
      return 'users';
    }

    public function fieldsFill() {
      return "id, name, image, email, is_deleted, is_admin, password";
    }

    public function isPasswordVerified($user) {
      $isPasswordVerified = true;
      if (isset($_POST['password'])) {
        $isPasswordVerified = password_verify($_POST['password'], $user['password']); 
      }
      return $isPasswordVerified;
    }

    public function hasUser($user) {
      if (!empty($user) && $this->isPasswordVerified($user)) {
        return true;
      }
      return false;
    }
  }
?>