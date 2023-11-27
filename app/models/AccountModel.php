<?php 
  class AccountModel extends Model {
    public function tableFill() {
      return 'users';
    }

    public function fieldsFill() {
      return "id, name, image, email, is_deleted, is_admin, password";
    }

    public function hasUser($user) {
      $isPasswordVerified = password_verify($_POST['password'], $user['password']); 
      if (!empty($user) && $isPasswordVerified) {
        return true;
      }
      return false;
    }
  }
?>