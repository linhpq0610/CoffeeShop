<?php 
  class Account extends Controller {
    private $__accountModel;

    function __construct() {
      $this->__accountModel = $this->getModel("AccountModel");
    }

    public function index() {
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/account';
      $this->_data['pageTitle'] = 'Tài khoản';
      $this->_data["contentOfPage"] = $this->showContentOfAccount();
      $this->renderClientLayout($this->_data);
    }

    public function showContentOfAccount() {
      if ($this->isSignIng()) {
        $customer = $this->__accountModel->selectOneRowById($_COOKIE[COOKIE_LOGIN_NAME]);
        $customer['role'] = $customer['role'] ? 'checked' : '';
        return $customer;
      }

      return [];
    }

    public function loadFormSignIn() {
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/formSignIn';
      $this->_data['pageTitle'] = 'Đăng nhập';
      $this->_data["contentOfPage"] = [];
      $this->renderClientLayout($this->_data);
    }

    public function checkSignIn() {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $hasCustomer = $this->__accountModel->hasCustomer(
        ["email" => $email, "password" => $password],
        "AND"
      ); 
      if ($hasCustomer) {
        $this->signIn();
      }

      App::$app->loadError("customerNotExist");
    }

    public function signIn() {
      $customer = $this->__accountModel->getCustomer();
      extract($customer);
      define("SECONDS_OF_MONTH", 86400 * 30);
      setcookie(COOKIE_LOGIN_NAME, $id, time() + SECONDS_OF_MONTH);

      header("Location: " . HOME_ROUTE);
    }

    public function loadFormSignUp() {
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/formSignUp';
      $this->_data['pageTitle'] = 'Đăng ký';
      $this->_data["contentOfPage"] = [];
      $this->renderClientLayout($this->_data);
    }

    public function checkSignUp() {
      $email = $_POST['email'];

      $hasCustomer = $this->__accountModel->hasCustomer(
        ["email" => $email],
        "AND"
      ); 

      if (!$hasCustomer) {
        $data = [
          "name" => $_POST['name'],
          "email" => $email,
          "password" => $_POST['password'],
          "image" => 'default-customer-image.png',
        ];

        $avatarImageName = $_FILES['avatar']['name'];
        if ($avatarImageName != "") {
          $data["image"] = $avatarImageName;
        }
        move_uploaded_file(
          $_FILES['avatar']['tmp_name'], 
          IMAGES_DIR . "/" . "$avatarImageName"
        );

        $this->signUp($data);
      }

      App::$app->loadError("emailExisted");
    }

    public function signUp($data) {
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $DB->insert($tableName, $data);
      header("Location: " . FORM_SIGN_IN_ROUTE);
    }

    public function signOut() {
      setcookie(COOKIE_LOGIN_NAME);
      header("Location: " . HOME_ROUTE);
    }

    public function update($id) {
      $data = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
      ];
      $avatarImageName = $_FILES['avatar']['name'];
      if ($avatarImageName != "") {
        $data["image"] = $avatarImageName;
      }
      move_uploaded_file(
        $_FILES['avatar']['tmp_name'], 
        IMAGES_DIR . "/" . "$avatarImageName"
      );
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $condition = "id = $id";
      $DB->update($tableName, $data, $condition);
      header("Location: " . ACCOUNT_ROUTE);
    }

    public function forgotPassword() {
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/forgotPassword';
      $this->_data['pageTitle'] = 'Quên mật khẩu';
      $this->_data["contentOfPage"] = [];
      $this->renderClientLayout($this->_data);
    }

    public function checkEmail() {
      $hasCustomer = $this->__accountModel->hasCustomer(
        ["email" => $_POST['email']],
        "AND"
      ); 
      if ($hasCustomer) {
        $this->showFormNewPassword();
      }
    }

    public function showFormNewPassword($id = '') {
      $customer = $this->__accountModel->getCustomer();

      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/newPassword';
      $this->_data['pageTitle'] = 'Mật khẩu mới';
      $this->_data["contentOfPage"] = [
        'customerId' => $id ?? $customer['id'],
      ];
      $this->renderClientLayout($this->_data);
    }

    public function setNewPassword($id) {
      $data = [
        "password" => $_POST['password'],
      ];
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $condition = "id = $id";
      $DB->update($tableName, $data, $condition);
      header("Location: " . SIGN_IN_ROUTE);
    }

    public function showFormChangePassword() {
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/changePassword';
      $this->_data['pageTitle'] = 'Thay đổi mật khẩu';
      $this->_data["contentOfPage"] = [];
      $this->renderClientLayout($this->_data);
    }

    public function isPasswordExist() {
      $customer = $this->__accountModel->selectOneRowById($_COOKIE[COOKIE_LOGIN_NAME]);
      if ($_POST['old-password'] == $customer['password']) {
        return true;
      }
      return false;
    }

    public function changePassword() {
      if ($this->isPasswordExist()) {
        $this->setNewPassword($_COOKIE[COOKIE_LOGIN_NAME]);
        header("Location: " . ACCOUNT_ROUTE);
      }
    }
  }
?>