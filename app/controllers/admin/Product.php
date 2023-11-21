<?php 
  class Product extends Controller {
    private $__productModel;
    private $__categoryModel;

    function __construct() {
      $this->__productModel = $this->getModel("ProductModel");
      $this->__categoryModel = $this->getModel("CategoryModel");
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
      $this->_data['pageTitle'] = 'Danh sách sản phẩm bị xoá';
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

    public function edit($id) {
      $product = $this->__productModel->selectOneRowById($id);
      $categories = $this->__categoryModel->selectAllRows();

      $product['categories'] = $categories;
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/products/edit';
      $this->_data['pageTitle'] = 'Chỉnh sửa ' . $product['name'];
      $this->_data["contentOfPage"] = $product;
      $this->renderAdminLayout($this->_data);
    }

    public function update($id) {
      $data = [
        "name" => $_POST['name'],
        "description" => $_POST['description'],
        "price" => $_POST['price'],
        "sale" => $_POST['sale'],
        "category_id" => $_POST['category_id'],
      ];

      $avatarImageName = $_FILES['avatar']['name'];
      if ($avatarImageName != "") {
        $data["image"] = $avatarImageName;
      }

      move_uploaded_file(
        $_FILES['avatar']['tmp_name'], 
        IMAGES_DIR . "/" . "$avatarImageName"
      );
      
      $DB = $this->__productModel->getDB();
      $tableName = $this->__productModel->tableFill();
      $condition = "id = $id";
      $DB->update($tableName, $data, $condition);
      header("Location: " . EDIT_PRODUCT_ROUTE . $id);
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

    public function showFormAddProduct() {
      $categories = $this->__categoryModel->selectAllRows();

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/products/add';
      $this->_data['pageTitle'] = 'Thêm sản phẩm';
      $this->_data["contentOfPage"] = ['categories' => $categories];
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
  }
?>