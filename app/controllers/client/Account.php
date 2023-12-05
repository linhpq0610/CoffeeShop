<?php 
  use Firebase\JWT\JWT;
  use Firebase\JWT\Key;
  class Account extends Controller {
    private $__accountModel;
    private $__client;

    function __construct() {
      $this->__accountModel = $this->getModel("AccountModel");
      $this->setGoogleClient();
    }

    public function index($formData = []) {
      if (!$this->isSignedIn()) {
        ErrorHandler::isNotSignedIn();
        die();
      }

      $formData = $this->setDefaultData($formData);
      $userId = $_SESSION['user']['id'];
      $user = $this->__accountModel->selectOneRowById($userId);
      $user['is_admin'] = $user['is_admin'] ? 'checked' : '';

      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/account';
      $this->_data['pageTitle'] = 'Tài khoản';
      $this->_data['contentOfPage'] = [
        'formData' => $formData,
        'user' => $user,
      ];
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

    public function getEmailAddresses() {
      $mailSend = 'linhpqpc05353@fpt.edu.vn';
      $mailReceive = $_POST['mail-receive'];
      $emailAddresses = [$mailSend, $mailReceive];
      return $emailAddresses;
    }

    public function getContentEmail() {
      $subject = mb_encode_mimeheader('THÔNG TIN ĐĂNG NHẬP - ĐÂY LÀ MẬT KHẨU CỦA BẠN', 'utf-8');
      $body = require_once CLIENT_VIEW_DIR . "/emails/passwordEmail.php" ;
      $content = [$subject, $body];
      return $content;
    }

    public function sendPasswordForUser() {
      $userId = $_POST['user-id'];
      $user = $this->__accountModel->selectOneRowById($userId);
      $this->signIn($user);

      $emailAddresses = $this->getEmailAddresses();
      $content = $this->getContentEmail();
      Mail::send($emailAddresses, $content);
    }

    public function getGoogleAccountInfo($token) {
      $this->__client->setAccessToken($token['access_token']);
      $googleOauth = new Google_Service_Oauth2($this->__client);
      $googleAccountInfo = $googleOauth->userinfo->get();
      return $googleAccountInfo;
    }

    public function insertAccountWithDefaultPassword($googleAccountInfo) {
      $defaultPassword = bin2hex(random_bytes(16));
      $_SESSION['default-password'] = $defaultPassword;
      $passwordEncrypted = password_hash($defaultPassword, PASSWORD_DEFAULT);
      $data = [
        "image" => DEFAULT_USER_IMAGE_NAME,
        'name' => $googleAccountInfo->name,
        'email' => $googleAccountInfo->email,
        'password' => $passwordEncrypted,
      ];
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $DB->insert($tableName, $data);
    }

    public function createNewPassword($userId) {
      $passwordEncrypted = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $data = [
        "password" => $passwordEncrypted,
      ];
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $condition = "id = $userId";
      $DB->update($tableName, $data, $condition);

      $user = $this->__accountModel->selectOneRowById($userId);
      $this->signIn($user);
    }

    public function getUserId($googleAccountInfo) {
      $email = $googleAccountInfo->email;
      $condition = " WHERE email = '$email'";
      $userId = $this->__accountModel->selectRowBy($condition)['id'];
      return $userId;
    }

    public function showFormCreatePassword($googleAccountInfo) {
      $userId = $this->getUserId($googleAccountInfo);
      $email = $googleAccountInfo->email;
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/createPasswordForm';
      $this->_data['pageTitle'] = 'Tạo mật khẩu';
      $this->_data['contentOfPage'] = [
        'userId' => $userId,
        'email' => $email,
      ];
      $this->renderClientLayout($this->_data);
    }

    public function handleSignInWhenAccountNotExist($googleAccountInfo) {
      $this->insertAccountWithDefaultPassword($googleAccountInfo);
      $this->showFormCreatePassword($googleAccountInfo);
    }

    public function checkSignInWithGoogle($googleAccountInfo) {
      $email = $googleAccountInfo->email;
      $this->handleSignIn($email);
      $this->handleSignInWhenAccountNotExist($googleAccountInfo);
    }

    public function handleSignInWithGoogle() {
      if (isset($_GET['code'])) {
        $token = $this->__client->fetchAccessTokenWithAuthCode($_GET['code']);
        if(!isset($token["error"])){
          $googleAccountInfo = $this->getGoogleAccountInfo($token);
          $this->checkSignInWithGoogle($googleAccountInfo);
        } else {
          header('Location: ' . FORM_SIGN_IN_ROUTE);
          exit;
        }
      }
    }

    public function setGoogleClient() {
      $this->__client = new Google_Client();
      $this->__client->setClientId(GOOGLE_APP_ID);
      $this->__client->setClientSecret(GOOGLE_APP_SECRET);
      $this->__client->setRedirectUri(GOOGLE_APP_SIGN_IN_CALLBACK_URL);

      $this->__client->addScope("email");
      $this->__client->addScope("profile");

      //! If these two lines are deleted, it will cause an error.
      $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
      $this->__client->setHttpClient($guzzleClient);
    }

    public function showFormSignIn($formData = []) {
      $formData = $this->setDefaultData($formData);
      $authUrl = $this->__client->createAuthUrl();

      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/formSignIn';
      $this->_data['pageTitle'] = 'Đăng nhập';
      $this->_data['contentOfPage'] = [
        'formData' => $formData,
        'authUrl' => $authUrl,
      ];
      $this->renderClientLayout($this->_data);
    }

    public function notifyAccountNotExist() {
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

    public function handleSignIn($email) {
      $condition = 
        " WHERE" . 
          " email = '$email' AND" . 
          " is_deleted = 0";

      $user = $this->__accountModel->selectRowBy($condition);
      $hasUser = $this->__accountModel->hasUser($user); 
      if ($hasUser) {
        $this->signIn($user);
        die();
      }
    }

    public function checkSignIn() {
      $email = $_POST['email'];
      $this->handleSignIn($email);
      $this->notifyAccountNotExist();
    }

    public function addUserToken($user) {
      $secretKey = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
      $data = $user;

      $jwt = JWT::encode(
        $data,
        $secretKey,
        'HS256'
      );

      $SECONDS_PER_WEEK = 86400 * 7;
      $EXPIRATION_DATE = time() + $SECONDS_PER_WEEK;
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

    public function notifySuccessSignUp() {
      $messageSuccess = 
        '<p class="p-3">
          Bạn đã đăng ký thành công.
        </p>';
      $formData = [
        'messageSuccess' => $messageSuccess,
      ];
      $this->showFormSignIn($formData);
    }

    public function signUp($data) {
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $DB->insert($tableName, $data);
      $this->notifySuccessSignUp();
    }

    public function initSignUp() {
      $passwordEncrypted = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $data = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "password" => $passwordEncrypted,
        "image" => DEFAULT_USER_IMAGE_NAME,
      ];

      $data = $this->getImageUploaded($data, USERS_UPLOAD_DIR);
      $this->signUp($data);
    }

    public function hasUser($email) {
      $email = $email != '' ? $email : $_POST['email'];
      $condition = " WHERE email = '$email'";

      $user = $this->__accountModel->selectRowBy($condition);
      $hasUser = $this->__accountModel->hasUser($user); 
      return $hasUser;
    }

    public function notifySignUpFail() {
      $messageAlert = 
        '<p class="p-3">
          Email đã được sử dụng.
          <br>
          Vui lòng dùng email khác.
        </p>';
      $formData = [
        'messageAlert' => $messageAlert,
        'name' => $_POST['name'],
        'email' => $_POST['email'],
      ];
      $this->showFormSignUp($formData);
    }

    public function checkSignUp($email = '') {
      $hasUser = $this->hasUser($email); 
      if (!$hasUser) {
        $this->initSignUp();
      }

      $this->notifySignUpFail();
    }

    public function handleSignOut() {
      $_SESSION = [];
      unset($_COOKIE['userToken']);
      setcookie('userToken');
    }

    public function notifySuccessSignOut() {
      $messageSuccess = 
        '<p class="p-3">
          Bạn đã đăng xuất thành công.
        </p>';
      $formData = [
        'messageSuccess' => $messageSuccess,
      ];
      $this->showFormSignIn($formData);
    }

    public function signOut() {
      $this->handleSignOut();
      $this->notifySuccessSignOut();
    }

    public function notifySuccessUpdate() {
      $messageSuccess = 
        '<p class="p-3">
          Bạn đã cập nhật thành công.
        </p>';
      $formData = [
        'messageSuccess' => $messageSuccess,
      ];
      $this->index($formData);
    }

    public function update($id) {
      $data = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
      ];

      $data = $this->getImageUploaded($data, USERS_UPLOAD_DIR);
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $condition = "id = $id";
      $DB->update($tableName, $data, $condition);
      
      $this->notifySuccessUpdate();
    }

    public function notifyEmailExist() {
      $messageAlert = 
        '<p class="p-3">
          Email đã được sử dụng.
          <br>
          Vui lòng dùng email khác.
        </p>';
      $formData = [
        'messageAlert' => $messageAlert,
      ];
      $this->index($formData);
    }

    public function checkWhenUpdate($id) {
      $id = $_POST['id'];
      $email = $_POST['email'];
      $condition = 
        " WHERE" . 
          " email = '$email' AND" . 
          " id <> $id AND" . 
          " is_deleted = 0";

      $user = $this->__accountModel->selectRowBy($condition);
      $hasUser = $this->__accountModel->hasUser($user);
      if (!$hasUser) {
        $this->update($id);
      }

      $this->notifyEmailExist();
    }

    public function showFormForgotPassword($formData = []) {
      $formData = $this->setDefaultData($formData);
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/account/forgotPassword';
      $this->_data['pageTitle'] = 'Quên mật khẩu';
      $this->_data["contentOfPage"] = $formData;
      $this->renderClientLayout($this->_data);
    }

    public function notifyEmailNotExist() {
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

      $this->notifyEmailNotExist();
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

    public function handleSetNewPassword($id) {
      $passwordEncrypted = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $data = [
        "password" => $passwordEncrypted,
      ];
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $condition = "id = $id";
      $DB->update($tableName, $data, $condition);
    }

    public function setNewPassword($id) {
      $this->handleSetNewPassword($id);
      $this->handleSignOut();
      $this->notifySuccessChangePassword();
    }
    
    public function changePassword() {
      if ($this->isPasswordExist()) {
        $this->setNewPassword($_SESSION['user']['id']);
      }

      $this->handleWhenPasswordNotExist();
    }

    public function notifySuccessDeleteAccount() {
      $messageSuccess = 
        '<p class="p-3">
            Bạn đã xóa tài khoản thành công.
        </p>';
      $formData = [
        'messageSuccess' => $messageSuccess,
      ];
      $this->showFormSignIn($formData);
    }

    public function softDelete($id) {
      $data = [
        "is_deleted" => 1,
      ];
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $condition = "id IN ($id)";
      $DB->update($tableName, $data, $condition);
      $this->handleSignOut();
      $this->notifySuccessDeleteAccount();     
    }
  }
?>
