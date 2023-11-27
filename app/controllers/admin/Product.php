<?php 
  class Product extends Controller {
    private $__productModel;
    private $__categoryModel;

    function __construct() {
      $this->__productModel = $this->getModel("ProductModel");
      $this->__categoryModel = $this->getModel("CategoryModel");
    }

    public function setDefaultData($data) {
      $defaultData = [
        'messageAlert' => '',
        'messageSuccess' => '',
        "name" => '',
        "description" => '',
        "price" => '',
        "sale" => '',
      ];
      foreach ($data as $key => $value) {
        $defaultData[$key] = $value;
      }
      return $defaultData;
    }

    public function index($currentPage, $wherePhrase = " WHERE is_deleted = 0") {
      [$currentPage, $NUMBERS_OF_ROW, $condition] = 
        $this->initPagination($currentPage, $wherePhrase, $this->__productModel);
      [$prevPageBtn, $nextPageBtn] = 
        $this->getBtnPagination($currentPage, $NUMBERS_OF_ROW, ADMIN_PRODUCT_ROUTE);
      $products = $this->__productModel->selectRowsBy($condition);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/products/list';
      $this->_data['pageTitle'] = 'Danh sách sản phẩm';
      $this->_data["contentOfPage"] = [
        'products' => $products,
        'NUMBERS_OF_ROW' => $NUMBERS_OF_ROW,
        'currentPage' => $currentPage,
        'prevPageBtn' => $prevPageBtn,
        'nextPageBtn' => $nextPageBtn,
      ];
      $this->renderAdminLayout($this->_data);
    }
    
    public function showProductsDeleted($currentPage, $wherePhrase = " WHERE is_deleted = 1") {
      [$currentPage, $NUMBERS_OF_ROW, $condition] = 
        $this->initPagination($currentPage, $wherePhrase, $this->__productModel);
      [$prevPageBtn, $nextPageBtn] = 
        $this->getBtnPagination($currentPage, $NUMBERS_OF_ROW, PRODUCT_DELETED_ROUTE);
      $products = $this->__productModel->selectRowsBy($condition);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/products/productsDeleted';
      $this->_data['pageTitle'] = 'Danh sách sản phẩm đã xoá';
      $this->_data["contentOfPage"] = [
        'products' => $products,
        'NUMBERS_OF_ROW' => $NUMBERS_OF_ROW,
        'currentPage' => $currentPage,
        'prevPageBtn' => $prevPageBtn,
        'nextPageBtn' => $nextPageBtn,
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function info($id) {
      $product = $this->__productModel->selectOneRowById($id);
      $categoryId = $product['category_id'];
      $categoryName = $this->__categoryModel->selectOneRowById($categoryId)['name'];
      $product['categoryName'] = $categoryName;

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/products/info';
      $this->_data['pageTitle'] = $product['name'];
      $this->_data["contentOfPage"] = $product;
      $this->renderAdminLayout($this->_data);
    }

    public function edit($id, $formData = []) {
      $formData = $this->setDefaultData($formData);
      $condition = ' WHERE is_deleted = 0';
      $categories = $this->__categoryModel->selectRowsBy($condition);
      $product = $this->__productModel->selectOneRowById($id);

      $product['categories'] = $categories;
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/products/edit';
      $this->_data['pageTitle'] = 'Chỉnh sửa ' . $product['name'];
      $this->_data["contentOfPage"] = [
        'product' => $product,
        'formData' => $formData,
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function hasProduct() {
      $name = $_POST['name'];
      $condition = " WHERE name = '$name'";
      $product = $this->__productModel->selectRowBy($condition);
      return !empty($product);
    }

    public function getFormData() {
      $messageAlert = 
        '<p class="p-3">
          Sản phẩm đã tồn tại.
          <br>
          Vui lòng dùng tên khác.
        </p>';
      $formData = [
        'messageAlert' => $messageAlert,
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'sale' => $_POST['sale'],
      ];
      return $formData;
    }

    public function update($id) {
      $data = [
        "name" => $_POST['name'],
        "description" => $_POST['description'],
        "price" => $_POST['price'],
        "sale" => $_POST['sale'],
        "category_id" => $_POST['category_id'],
      ];
      
      $data = $this->getImageUploaded($data);
      $DB = $this->__productModel->getDB();
      $tableName = $this->__productModel->tableFill();
      $condition = "id = $id";
      $DB->update($tableName, $data, $condition);
      
      $messageSuccess = 
        '<p class="p-3">
          Bạn đã cập nhật thành công.
        </p>';
      $formData = ['messageSuccess' => $messageSuccess];
      $this->edit($id, $formData);
    }

    public function checkProductWhenUpdate($id) {
      if (!$this->hasProduct()) {
        $this->update($id);
      }

      $formData = $this->getFormData();
      $this->edit($id, $formData);
    }

    public function softDelete() {
      $data = [
        "is_deleted" => 1,
      ];
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__productModel->getDB();
      $tableName = $this->__productModel->tableFill();
      $condition = "id IN ($ids)";
      $DB->update($tableName, $data, $condition);
      header("Location: " . ADMIN_PRODUCT_ROUTE . "1");
    }

    public function showFormAddProduct($formData = []) {
      $formData = $this->setDefaultData($formData);
      $condition = ' WHERE is_deleted = 0';
      $categories = $this->__categoryModel->selectRowsBy($condition);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/products/add';
      $this->_data['pageTitle'] = 'Thêm sản phẩm';
      $this->_data["contentOfPage"] = [
        'categories' => $categories, 
        'formData' => $formData, 
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function initAdd() {
      $data = [
        "name" => $_POST['name'],
        "description" => $_POST['description'],
        "price" => $_POST['price'],
        "sale" => $_POST['sale'],
        "category_id" => $_POST['category_id'],
        "image" => 'default-product-image.png',
      ];

      $data = $this->getImageUploaded($data);
      $this->add($data);
    }

    public function checkProductWhenAdd() {
      if (!$this->hasProduct()) {
        $this->initAdd();
      }

      $formData = $this->getFormData();
      $this->showFormAddProduct($formData);
    }

    public function add($data) {
      $DB = $this->__productModel->getDB();
      $tableName = $this->__productModel->tableFill();
      $DB->insert($tableName, $data);
      header("Location: " . ADMIN_PRODUCT_ROUTE . "1");
    }

    public function searchProductsByNameAndDescription() {
      $searchMessage = $_POST['search-box'];
      $wherePhrase = 
        " WHERE" . 
          " name LIKE '%$searchMessage%' OR " . 
          " description LIKE '%$searchMessage%' AND" . 
          " is_deleted = 0";
      $this->index(1, $wherePhrase);
    }

    public function searchProductsDeletedByNameAndDescription() {
      $searchMessage = $_POST['search-box'];
      $wherePhrase = 
        " WHERE" . 
          " name LIKE '%$searchMessage%' OR " . 
          " description LIKE '%$searchMessage%' AND" . 
          " is_deleted = 1";
      $this->showProductsDeleted(1, $wherePhrase);
    }

    public function restore() {
      $data = [
        "is_deleted" => 0,
      ];
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__productModel->getDB();
      $tableName = $this->__productModel->tableFill();
      $condition = "id IN ($ids)";
      $DB->update($tableName, $data, $condition);
      header("Location: " . PRODUCT_DELETED_ROUTE . "1");
    }
    
    public function hardDelete() {
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__productModel->getDB();
      $tableName = $this->__productModel->tableFill();
      $condition = "id IN ($ids)";
      $DB->delete($tableName, $condition);
      header("Location: " . PRODUCT_DELETED_ROUTE . "1");
    }

    public function handleActionInProductsDeleted() {
      if ($_POST['action'] == 'restore') {
        $this->restore();
        die();
      }

      $this->hardDelete();
    }
  }
?>
