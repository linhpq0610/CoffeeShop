<?php 
  class User extends Controller {
    private $__accountModel;

    function __construct() {
      $this->__accountModel = $this->getModel("AccountModel");
    }

    public function setDefaultData($data) {
      $defaultData = [
        'messageAlert' => '',
        'messageSuccess' => '',
        'name' => '',
        'email' => '',
      ];
      $defaultData = $this->mergeDataIntoDefault($defaultData, $data);
      return $defaultData;
    }

    public function index($currentPage, $wherePhrase = " WHERE is_deleted = 0") {
      [$currentPage, $NUMBERS_OF_ROW, $condition] = 
        $this->initPagination($currentPage, $wherePhrase, $this->__accountModel);
      [$prevPageBtn, $nextPageBtn] = 
        $this->getBtnPagination($currentPage, $NUMBERS_OF_ROW, USER_ROUTE);
      $users = $this->__accountModel->selectRowsBy($condition);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/users/list';
      $this->_data['pageTitle'] = 'Danh sách người dùng';
      $this->_data["contentOfPage"] = [
        'users' => $users,
        'NUMBERS_OF_ROW' => $NUMBERS_OF_ROW,
        'currentPage' => $currentPage,
        'prevPageBtn' => $prevPageBtn,
        'nextPageBtn' => $nextPageBtn,
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function showUsersDeleted($currentPage, $wherePhrase = " WHERE is_deleted = 1") {
      [$currentPage, $NUMBERS_OF_ROW, $condition] = 
        $this->initPagination($currentPage, $wherePhrase, $this->__accountModel);
      [$prevPageBtn, $nextPageBtn] = 
        $this->getBtnPagination($currentPage, $NUMBERS_OF_ROW, USER_ROUTE);
      $users = $this->__accountModel->selectRowsBy($condition);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/users/usersDeleted';
      $this->_data['pageTitle'] = 'Danh sách người dùng đã xóa';
      $this->_data["contentOfPage"] = [
        'users' => $users,
        'NUMBERS_OF_ROW' => $NUMBERS_OF_ROW,
        'currentPage' => $currentPage,
        'prevPageBtn' => $prevPageBtn,
        'nextPageBtn' => $nextPageBtn,
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function info($id) {
      $user = $this->__accountModel->selectOneRowById($id);
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/users/info';
      $this->_data['pageTitle'] = $user['name'];
      $this->_data["contentOfPage"] = $user;
      $this->renderAdminLayout($this->_data);
    }

    public function edit($id, $formData = []) {
      $formData = $this->setDefaultData($formData);
      $user = $this->__accountModel->selectOneRowById($id);
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/users/edit';
      $this->_data['pageTitle'] = 'Chỉnh sửa người dùng';
      $this->_data["contentOfPage"] = [
        'user' => $user, 
        'formData' => $formData, 
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function hasUser() {
      $email = $_POST['email'];
      $condition = " WHERE email = '$email'";

      $user = $this->__accountModel->selectRowBy($condition);
      return $this->__accountModel->hasUser($user);
    }

    public function getFormData() {
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
      return $formData;
    }

    public function checkUserWhenUpdate($id) {
      if (!$this->hasUser()) {
        $this->update($id);
      }

      $formData = $this->getFormData();
      $this->edit($id, $formData);
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
      
      $messageSuccess = 
        '<p class="p-3">
          Bạn đã cập nhật thành công.
        </p>';
      $formData = ['messageSuccess' => $messageSuccess];
      $this->edit($id, $formData);
    }

    public function softDelete() {
      $data = [
        "is_deleted" => 1,
      ];
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $condition = "id IN ($ids)";
      $DB->update($tableName, $data, $condition);
      header("Location: " . USER_ROUTE . "1");
    }

    public function showFormAddUser($formData = []) {
      $formData = $this->setDefaultData($formData);
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/users/add';
      $this->_data['pageTitle'] = 'Thêm người dùng';
      $this->_data["contentOfPage"] = $formData;
      $this->renderAdminLayout($this->_data);
    }

    public function initAdd() {
      $passwordEncrypted = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $data = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "password" => $passwordEncrypted,
        "image" => 'default-user-image.webp',
      ];
      $data = $this->getImageUploaded($data);
      $this->add($data);
    }

    public function add($data) {
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $DB->insert($tableName, $data);
      header("Location: " . USER_ROUTE . "1");
    }
    
    public function checkUserWhenAdd() {
      if (!$this->hasUser()) {
        $this->initAdd();
      }

      $formData = $this->getFormData();
      $this->showFormAddUser($formData);
    }

    public function searchUsersByNameAndEmail() {
      $searchMessage = $_POST['search-box'];
      $wherePhrase = 
        " WHERE" . 
          " (name LIKE '%$searchMessage%' OR" .
          " email LIKE '%$searchMessage%') AND" . 
          " is_deleted = 0";
      $this->index(1, $wherePhrase);
    }
   
    public function searchUsersDeletedByNameAndEmail() {
      $searchMessage = $_POST['search-box'];
      $wherePhrase = 
        " WHERE" . 
          " (name LIKE '%$searchMessage%' OR" .
          " email LIKE '%$searchMessage%') AND" . 
          " is_deleted = 1";
      $this->showUsersDeleted(1, $wherePhrase);
    }

    public function restore() {
      $data = [
        "is_deleted" => 0,
      ];
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $condition = "id IN ($ids)";
      $DB->update($tableName, $data, $condition);
      header("Location: " . USER_DELETED_ROUTE . "1");
    }
    
    public function hardDelete() {
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $condition = "id IN ($ids)";
      $DB->delete($tableName, $condition);
      header("Location: " . USER_DELETED_ROUTE . "1");
    }

    public function handleActionInUsersDeleted() {
      if ($_POST['action'] == 'restore') {
        $this->restore();
        die();
      }

      $this->hardDelete();
    }

  }
?>
