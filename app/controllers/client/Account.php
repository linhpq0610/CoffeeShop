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
      if ($this->isSignedIn()) {
        $customer = $this->__accountModel->selectOneRowById($_COOKIE[COOKIE_LOGIN_NAME]);
        $customer['role'] = $customer['role'] ? 'checked' : '';
        return $customer;
      }

      return [];
    }

    public function setDefaultData($data) {
      $defaultData = [
        'messageSuccess' => '',
        'messageAlert' => '',
        'name' => '',
        'email' => '',
        'password' => '',
      ];
      foreach ($data as $key => $value) {
        $defaultData[$key] = $value;
      }
      return $defaultData;
    }

    public function loadFormSignIn($formData = []) {
      $formData = $this->setDefaultData($formData);
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/formSignIn';
      $this->_data['pageTitle'] = 'Đăng nhập';
      $this->_data['contentOfPage'] = $formData;
      $this->renderClientLayout($this->_data);
    }

    public function checkSignIn() {
      $email = $_POST['email'];
      $password = $_POST['password'];
      $condition = " WHERE email = '$email' AND password = '$password'";

      $customer = $this->__accountModel->selectRowBy($condition);
      $hasCustomer = $this->__accountModel->hasCustomer($customer); 
      if ($hasCustomer) {
        $this->signIn($customer);
      }

      $messageAlert = 
        '<p class="p-3">
          Email hoặc mật khẩu không chính xác.
          <br>
          Vui lòng kiểm tra lại.
        </p>';
      $formData = [
        'messageAlert' => $messageAlert,
        'email' => $email,
        'password' => $password,
      ];
      $this->loadFormSignIn($formData);
    }

    public function signIn($customer) {
      define("SECONDS_OF_MONTH", 86400 * 30);
      setcookie(COOKIE_LOGIN_NAME, $customer['id'], time() + SECONDS_OF_MONTH);
      header("Location: " . HOME_ROUTE);
    }

    public function loadFormSignUp($formData = []) {
      $formData = $this->setDefaultData($formData);
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/formSignUp';
      $this->_data['pageTitle'] = 'Đăng ký';
      $this->_data['contentOfPage'] = $formData;
      $this->renderClientLayout($this->_data);
    }

    public function signUp($data) {
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $DB->insert($tableName, $data);
      
      $messageSuccess = 
        '<p class="p-3">
          Bạn đã đăng ký thành công.
          <br>
          Vui lòng đăng nhập tại đây.
        </p>';
      $formData = [
        'messageSuccess' => $messageSuccess,
      ];
      $this->loadFormSignIn($formData);
    }

    public function initSignUp() {
      $data = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
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

    public function checkSignUp() {
      $email = $_POST['email'];
      $condition = " WHERE email = '$email'";

      $customer = $this->__accountModel->selectRowBy($condition);
      $hasCustomer = $this->__accountModel->hasCustomer($customer); 
      if (!$hasCustomer) {
        $this->initSignUp();
      }

      $messageAlert = 
        '<p class="p-3">
          Email đã tồn tại.
          <br>
          Vui lòng dùng email khác.
        </p>';
      $formData = [
        'messageAlert' => $messageAlert,
        'name' => $_POST['name'],
        'email' => $email,
        'password' => $_POST['password'],
      ];
      $this->loadFormSignUp($formData);
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
