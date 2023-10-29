<?php 
  class Product extends Controller {
    private $__productModel;
    private $__categoryModel;
    private $__commentModel;
    private $__accountModel;

    function __construct() {
      $this->__productModel = $this->getModel("ProductModel");
      $this->__categoryModel = $this->getModel("CategoryModel");
      $this->__commentModel = $this->getModel("CommentModel");
      $this->__accountModel = $this->getModel("AccountModel");
    }

    public function shouldCountProductsFound($wherePhrase, $categories) {
      return 
        $wherePhrase != '' && 
        (
          !isset($_POST['category_id']) || 
          count($_POST['category_id']) != count($categories)
        );
    }

    public function index($currentPage, $wherePhrase = "") {
      [$currentPage, $NUMBERS_OF_ROW, $condition] = 
        $this->initPagination($currentPage, $wherePhrase, $this->__productModel);
      [$prevPageBtn, $nextPageBtn] = 
        $this->getBtnPagination($currentPage, $NUMBERS_OF_ROW, SHOP_ROUTE);
      
      $products = $this->__productModel->selectRowsByData($condition);
      $categories = $this->__categoryModel->selectAllRows();
      $countOfProducts = $this->__productModel->getCountOfProductOfCategory();

      $countOfAllProducts = $this->__productModel->getCountOfRow();
      $countOfProductsFound = $countOfAllProducts;
      if ($this->shouldCountProductsFound($wherePhrase, $categories)) {
        $countOfProductsFound = count($products);
      }
      
      $this->_data["pathToPage"] = CLIENT_VIEW_DIR . "/products/list";
      $this->_data["pageTitle"] = "Danh sách sản phẩm";
      $this->_data["contentOfPage"] = [
        'products' => $products, 
        "categories" => $categories,
        "countOfProducts" => $countOfProducts,
        "countOfProductsFound" => $countOfProductsFound,
        "countOfAllProducts" => $countOfAllProducts,
        'NUMBERS_OF_ROW' => $NUMBERS_OF_ROW,
        'currentPage' => $currentPage,
        'prevPageBtn' => $prevPageBtn,
        'nextPageBtn' => $nextPageBtn,
      ];
      $this->renderClientLayout($this->_data);
    }

    public function detail($id) {
      $product = $this->__productModel->selectOneRowById($id);
      $category_id = $product['category_id'];
      $condition = 
        " WHERE category_id = $category_id AND id <> $id" .
        " LIMIT 8";
      $productsRelated = $this->__productModel->selectRowsByData($condition);
      $comments = $this->__commentModel->getComments($id);
      $NUMBERS_OF_COMMENT = count($comments);

      $this->updateView($product['view'], $id);
      $this->_data['pageTitle'] = $product['name'];
      $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/products/detail';
      $this->_data['contentOfPage'] = [
        "product" => $product,
        "productsRelated" => $productsRelated,
        "comments" => $comments,
        "NUMBERS_OF_COMMENT" => $NUMBERS_OF_COMMENT,
      ];

      if ($this->isSignIng()) {
        $customerId = $_COOKIE[COOKIE_LOGIN_NAME];
        $customer = $this->__accountModel->selectOneRowById($customerId);
        $this->_data['contentOfPage']['customer'] = $customer;
      }
      $this->renderClientLayout($this->_data);
    }

    public function updateView($currentView, $id) {
      $data = ["view" => $currentView + 1];
      $DB = $this->__productModel->getDB();
      $tableName = $this->__productModel->tableFill();
      $condition = "id = $id";
      $DB->update($tableName, $data, $condition);
    }

    public function searchProductsByNameAndDescription() {
      $searchMessage = $_POST['search-box'];
      $wherePhrase = " WHERE name LIKE '%$searchMessage%' OR description LIKE '%$searchMessage%'";
      $this->index(1, $wherePhrase);
    }

    public function searchProductsByCategoryId($category_ids = '') {
      if ($category_ids == '') {
        $category_ids = implode(", ", $_POST['category_id']);
      }
      
      $wherePhrase = " WHERE category_id IN ($category_ids)";
      $this->index(1, $wherePhrase);
    }

    public function isChecked($id) {
      return 
        !isset($_POST['category_id']) ||
        in_array($id, $_POST['category_id']);
    }

    public function setChecked($id) {
      if ($this->isChecked($id)) {
        return 'checked';
      }
    }

    public function isCheckboxAllChecked() {
      return 
        !isset($_POST['category_id']) || 
        count($_POST['category_id']) == $this->__categoryModel->getCountOfRow();
    }

    public function setCheckboxAllChecked() {
      if ($this->isCheckboxAllChecked()) {
        return 'checked';
      }
    }

    public function addCommentInProduct($id) {
      $data = [
        "content" => $_POST['content'],
        "product_id" => $id,
        "customer_id" => $_COOKIE[COOKIE_LOGIN_NAME],
      ];

      $DB = $this->__commentModel->getDB();
      $tableName = $this->__commentModel->tableFill();
      $DB->insert($tableName, $data);
      header("Location: " . PRODUCT_DETAIL_ROUTE . $id);
    }
  }
?>