<?php 
  class Customer extends Controller {
    private $__accountModel;

    function __construct() {
      $this->__accountModel = $this->getModel("AccountModel");
    }

    public function index($currentPage, $wherePhrase = "") {
      [$currentPage, $NUMBERS_OF_ROW, $condition] = 
        $this->initPagination($currentPage, $wherePhrase, $this->__accountModel);
      [$prevPageBtn, $nextPageBtn] = 
        $this->getBtnPagination($currentPage, $NUMBERS_OF_ROW, CUSTOMER_ROUTE);
      $customers = $this->__accountModel->selectCustomersByData($condition);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/customer/list';
      $this->_data['pageTitle'] = 'Danh sách khách hàng';
      $this->_data["contentOfPage"] = [
        'customers' => $customers,
        'NUMBERS_OF_ROW' => $NUMBERS_OF_ROW,
        'currentPage' => $currentPage,
        'prevPageBtn' => $prevPageBtn,
        'nextPageBtn' => $nextPageBtn,
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function info($id) {
      $customer = $this->__accountModel->selectOneRowById($id);
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/customer/info';
      $this->_data['pageTitle'] = $customer['name'];
      $this->_data["contentOfPage"] = $customer;
      $this->renderAdminLayout($this->_data);
    }

    public function edit($id) {
      $customer = $this->__accountModel->selectOneRowById($id);
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/customer/edit';
      $this->_data['pageTitle'] = 'Chỉnh sửa khách hàng';
      $this->_data["contentOfPage"] = $customer;
      $this->renderAdminLayout($this->_data);
    }

    public function update($id) {
      $active = $_POST['active'] ? 1 : 0;
      $data = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "active" => $active,
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
      header("Location: " . EDIT_CUSTOMER_ROUTE . $id);
    }

    public function delete() {
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $condition = "id IN ($ids)";
      $DB->delete($tableName, $condition);
      header("Location: " . CUSTOMER_ROUTE . "1");
    }

    public function showFormAddCustomer() {
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/customer/add';
      $this->_data['pageTitle'] = 'Thêm khách hàng';
      $this->_data["contentOfPage"] = [];
      $this->renderAdminLayout($this->_data);
    }

    public function initAdd() {
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
      $this->add($data);
    }

    public function add($data) {
      $DB = $this->__accountModel->getDB();
      $tableName = $this->__accountModel->tableFill();
      $DB->insert($tableName, $data);
      header("Location: " . CUSTOMER_ROUTE . "1");
    }

    public function searchCustomersByNameAndEmail() {
      $searchMessage = $_POST['search-box'];
      $wherePhrase = " WHERE name LIKE '%$searchMessage%' OR email LIKE '%$searchMessage%'";
      $this->index(1, $wherePhrase);
    }
  }
?>