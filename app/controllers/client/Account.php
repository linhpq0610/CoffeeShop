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

    public function getGoogleAccountInfo($token) {
      $this->__client->setAccessToken($token['access_token']);
      $googleOauth = new Google_Service_Oauth2($this->__client);
      $googleAccountInfo = $googleOauth->userinfo->get();
      return $googleAccountInfo;
    }

    public function handleSignInWithGoogle() {
      if (isset($_GET['code'])) {
        $token = $this->__client->fetchAccessTokenWithAuthCode($_GET['code']);
        if(!isset($token["error"])){
          $googleAccountInfo = $this->getGoogleAccountInfo($token);
          $this->checkSignIn($googleAccountInfo->email);
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

    public function checkSignIn($email = '') {
      $email = $email != '' ? $email : $_POST['email'];
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
        "image" => 'default-user-image.webp',
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

      $data = $this->getImageUploaded($data, USERS_UPLOAD_DIR);
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
