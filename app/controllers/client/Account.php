<?php 
  use Firebase\JWT\JWT;
  use Firebase\JWT\Key;
  class Account extends Controller {
    private $__accountModel;

    function __construct() {
      $this->__accountModel = $this->getModel("AccountModel");
    }

    public function index() {
      if (!$this->isSignedIn()) {
        ErrorHandler::isNotSignedIn();
        die();
      }
      
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/account';
      $this->_data['pageTitle'] = 'Tài khoản';

      $user = $_SESSION['user'];
      $user['is_admin'] = $user['is_admin'] ? 'checked' : '';
      $this->_data['contentOfPage'] = $user;
      $this->renderClientLayout($this->_data);
    }

    public function setDefaultData($data) {
      $defaultData = [
        'messageSuccess' => '',
        'messageAlert' => '',
        'name' => '',
        'email' => '',
      ];
      $defaultData = $this->mergeDataIntoDefault($defaultData, $data);
      return $defaultData;
    }

    public function showFormSignIn($formData = []) {
      $formData = $this->setDefaultData($formData);
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/formSignIn';
      $this->_data['pageTitle'] = 'Đăng nhập';
      $this->_data['contentOfPage'] = $formData;
      $this->renderClientLayout($this->_data);
    }

    public function checkSignIn() {
      $email = $_POST['email'];
      $condition = 
        " WHERE" . 
          " email = '$email' AND" . 
          " is_deleted = 0";

      $user = $this->__accountModel->selectRowBy($condition);
      $hasUser = $this->__accountModel->hasUser($user); 
      if ($hasUser) {
        $this->signIn($user);
      }

      $messageAlert = 
        '<p class="p-3">
          Tài khoản không tồn tại.
          <br>
          Nếu quên mật khẩu bạn có thể thay đổi <a href="' . FORGOT_PASSWORD_ROUTE .'">tại đây</a>.
        </p>';
      $formData = [
        'messageAlert' => $messageAlert,
        'email' => $email,
      ];
      $this->showFormSignIn($formData);
    }

    public function generateToken() {
      return bin2hex(random_bytes(16));
    }

    public function addUserToken($user) {
      $secretKey = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
      $data = $user;

      $jwt = JWT::encode(
        $data,
        $secretKey,
        'HS256'
      );

      $SECONDS_PER_MONTH = 86400;
      $EXPIRATION_DATE = time() + $SECONDS_PER_MONTH;
      setcookie('userToken', $jwt, $EXPIRATION_DATE);
    }

    public function autoSignIn() {
      $secretKey = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
      $jwt = $_COOKIE['userToken'];
      $user = JWT::decode(
        $jwt,
        new Key($secretKey, 'HS256')
      );

      $_SESSION['user'] = (array)$user;
      header("Location: " . HOME_ROUTE);
    }

    public function signIn($user) {
      $_SESSION['user'] = $user;
      $this->addUserToken($user);
      header("Location: " . HOME_ROUTE);
    }

    public function showFormSignUp($formData = []) {
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
        </p>';
      $formData = [
        'messageSuccess' => $messageSuccess,
      ];
      $this->showFormSignIn($formData);
    }

    public function initSignUp() {
      $passwordEncrypted = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $data = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "password" => $passwordEncrypted,
        "image" => 'default-user-image.png',
      ];

      $data = $this->getImageUploaded($data);
      $this->signUp($data);
    }

    public function checkSignUp() {
      $email = $_POST['email'];
      $condition = " WHERE email = '$email'";

      $user = $this->__accountModel->selectRowBy($condition);
      $hasUser = $this->__accountModel->hasUser($user); 
      if (!$hasUser) {
        $this->initSignUp();
      }

      $messageAlert = 
        '<p class="p-3">
          Email đã được sử dụng.
          <br>
          Vui lòng dùng email khác.
        </p>';
      $formData = [
        'messageAlert' => $messageAlert,
        'name' => $_POST['name'],
        'email' => $email,
      ];
      $this->showFormSignUp($formData);
    }

    public function handleSignOut() {
      $_SESSION = [];
      setcookie('userToken', '', time() - 3600);
    }

    public function signOut() {
      $this->handleSignOut();
      header("Location: " . HOME_ROUTE);
    }

    public function update($id) {
      $data = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
      ];

      $data = $this->getImageUploaded($data);
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $condition = "id = $id";
      $DB->update($tableName, $data, $condition);
      header("Location: " . ACCOUNT_ROUTE);
    }

    public function showFormForgotPassword($formData = []) {
      $formData = $this->setDefaultData($formData);
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/forgotPassword';
      $this->_data['pageTitle'] = 'Quên mật khẩu';
      $this->_data["contentOfPage"] = $formData;
      $this->renderClientLayout($this->_data);
    }

    public function checkEmail() {
      $email = $_POST['email'];
      $condition = 
        " WHERE" . 
          " email = '$email' AND" . 
          " is_deleted = 0";

      $user = $this->__accountModel->selectRowBy($condition);
      $hasUser = $this->__accountModel->hasUser($user); 
      if ($hasUser) {
        $this->showFormNewPassword($user);
      }

      $messageAlert = 
        '<p class="p-3">
          Tài khoản không tồn tại.
          <br>
          Vui lòng kiểm tra lại.
        </p>';
      $formData = [
        'messageAlert' => $messageAlert,
        'email' => $_POST['email'],
      ];
      $this->showFormForgotPassword($formData);
    }

    public function showFormNewPassword($user) {
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/newPassword';
      $this->_data['pageTitle'] = 'Mật khẩu mới';
      $this->_data["contentOfPage"] = ['userId' => $user['id']];
      $this->renderClientLayout($this->_data);
    }

    public function notifySuccessChangePassword() {
      $messageSuccess = 
        '<p class="p-3">
          Bạn đã thay đổi mật khẩu thành công.
        </p>';
      $formData = [
        'messageSuccess' => $messageSuccess,
      ];
      $this->showFormSignIn($formData);
    }

    public function showFormChangePassword($formData = []) {
      $formData = $this->setDefaultData($formData);
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/changePassword';
      $this->_data['pageTitle'] = 'Thay đổi mật khẩu';
      $this->_data["contentOfPage"] = $formData;
      $this->renderClientLayout($this->_data);
    }

    public function isPasswordExist() {
      $isPasswordVerified = 
        password_verify($_POST['old-password'], $_SESSION['user']['password']);
      if ($isPasswordVerified) {
        return true;
      }
      return false;
    }

    public function handleWhenPasswordNotExist() {
      $messageAlert = 
        '<p class="p-3">
          Mật khẩu cũ không chính xác.
          <br>
          Nếu quên mật khẩu bạn có thể thay đổi <a href="' . FORGOT_PASSWORD_ROUTE .'">tại đây</a>.
        </p>';
      $formData = [
        'messageAlert' => $messageAlert,
      ];
      $this->showFormChangePassword($formData);
    }

    public function setNewPassword($id) {
      $passwordEncrypted = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $data = [
        "password" => $passwordEncrypted,
      ];
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $condition = "id = $id";
      $DB->update($tableName, $data, $condition);
      
      $this->notifySuccessChangePassword();
      $this->handleSignOut();
    }
    
    public function changePassword() {
      if ($this->isPasswordExist()) {
        $this->setNewPassword($_SESSION['user']['id']);
      }

      $this->handleWhenPasswordNotExist();
    }
  }
?>
