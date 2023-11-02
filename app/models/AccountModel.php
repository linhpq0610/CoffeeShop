<?php 
  class AccountModel extends Model {
    private $__customer;

    public function tableFill() {
      return 'customers';
    }

    public function fieldsFill() {
      return "id, name, image, email, active, role, password";
    }

    public function hasCustomer($customer) {
      return $customer != [] ? true : false;
    }
  }
?>