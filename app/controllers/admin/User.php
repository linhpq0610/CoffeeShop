<?php 
  class User extends Controller {
    private $__accountModel;

    function __construct() {
      $this->__accountModel = $this->getModel("AccountModel");
    }

    public function index($currentPage, $wherePhrase = "") {
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

    public function info($id) {
      $user = $this->__accountModel->selectOneRowById($id);
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/users/info';
      $this->_data['pageTitle'] = $user['name'];
      $this->_data["contentOfPage"] = $user;
      $this->renderAdminLayout($this->_data);
    }

    public function edit($id) {
      $user = $this->__accountModel->selectOneRowById($id);
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/users/edit';
      $this->_data['pageTitle'] = 'Chỉnh sửa người dùng';
      $this->_data["contentOfPage"] = $user;
      $this->renderAdminLayout($this->_data);
    }

    public function update($id) {
      $is_deleted = $_POST['is_deleted'] ? 1 : 0;
      $data = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "is_deleted" => $is_deleted,
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
      header("Location: " . EDIT_USER_ROUTE . $id);
    }

    public function delete() {
      // Đã xóa mềm
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $condition = "id IN ($ids)";
      $DB->delete($tableName, $condition);
      header("Location: " . USER_ROUTE . "1");
    }

    public function showFormAddUser() {
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/users/add';
      $this->_data['pageTitle'] = 'Thêm người dùng';
      $this->_data["contentOfPage"] = [];
      $this->renderAdminLayout($this->_data);
    }

    public function initAdd() {
      $data = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "image" => 'default-user-image.png',
      ];
      
      $avatarImageName = $_FILES['avatar']['name'];
      if ($avatarImageName != "") {
        $data["image"] = $avatarImageName;
      }

      move_uploaded_file(
        $_FILES['avatar']['tmp_name'], 
        IMAGES_DIR . "/" . "$avatarImageName"
      );
      $this->add($data);
    }

    public function add($data) {
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $DB->insert($tableName, $data);
      header("Location: " . USER_ROUTE . "1");
    }

    public function searchUsersByNameAndEmail() {
      $searchMessage = $_POST['search-box'];
      $wherePhrase = " WHERE name LIKE '%$searchMessage%' OR email LIKE '%$searchMessage%'";
      $this->index(1, $wherePhrase);
    }
  }
?>
