<?php 
  class AccountModel extends Model {
    public function tableFill() {
      return 'users';
    }

    public function fieldsFill() {
      return "id, name, image, email, active, role, password";
    }

    public function hasUser($user) {
      return $user != [] ? true : false;
    }
  }
?>