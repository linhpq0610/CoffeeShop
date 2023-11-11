<?php 
  class UserTokenModel extends Model {
    public function tableFill() {
      return 'user_tokens';
    }

    public function fieldsFill() {
      return "id, token, email, password, expiration_date, user_id";
    }
  }
?>
