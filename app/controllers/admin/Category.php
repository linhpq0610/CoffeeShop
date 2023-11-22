<?php 
  class Category extends Controller {
    private $__categoryModel;
    private $__productModel;

    function __construct() {
      $this->__categoryModel = $this->getModel("CategoryModel");
      $this->__productModel = $this->getModel("ProductModel");
    }

    public function index($currentPage, $wherePhrase = " WHERE is_deleted = 0") {
      [$currentPage, $NUMBERS_OF_ROW, $condition] = 
        $this->initPagination($currentPage, $wherePhrase, $this->__categoryModel);
      [$prevPageBtn, $nextPageBtn] = 
        $this->getBtnPagination($currentPage, $NUMBERS_OF_ROW, CATEGORY_ROUTE);
      $categories = $this->__categoryModel->selectRowsBy($condition);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/categories/list';
      $this->_data['pageTitle'] = 'Danh sách loại hàng';
      $this->_data["contentOfPage"] = [
        'categories' => $categories,
        'NUMBERS_OF_ROW' => $NUMBERS_OF_ROW,
        'currentPage' => $currentPage,
        'prevPageBtn' => $prevPageBtn,
        'nextPageBtn' => $nextPageBtn,
      ];
      $this->renderAdminLayout($this->_data);
    }

    public function showCategoriesDeleted($currentPage, $wherePhrase = " WHERE is_deleted = 1") {
      [$currentPage, $NUMBERS_OF_ROW, $condition] = 
        $this->initPagination($currentPage, $wherePhrase, $this->__categoryModel);
      [$prevPageBtn, $nextPageBtn] = 
        $this->getBtnPagination($currentPage, $NUMBERS_OF_ROW, CATEGORY_DELETED_ROUTE);
      $categories = $this->__categoryModel->selectRowsBy($condition);

      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/categories/categoriesDeleted';
      $this->_data['pageTitle'] = 'Danh sách loại hàng đã xóa';
      $this->_data["contentOfPage"] = [
        'categories' => $categories,
        'NUMBERS_OF_ROW' => $NUMBERS_OF_ROW,
        'currentPage' => $currentPage,
        'prevPageBtn' => $prevPageBtn,
        'nextPageBtn' => $nextPageBtn,
      ];
      $this->renderAdminLayout($this->_data);
    }
    
    public function edit($id) {
      $category = $this->__categoryModel->selectOneRowById($id);
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/categories/edit';
      $this->_data['pageTitle'] = 'Chỉnh sửa loại hàng';
      $this->_data["contentOfPage"] = $category;
      $this->renderAdminLayout($this->_data);
    }

    public function update($id) {
      $data = [
        "name" => $_POST['name'],
      ];
      
      $DB = $this->__categoryModel->getDB();
      $tableName = $this->__categoryModel->tableFill();
      $condition = "id = $id";
      $DB->update($tableName, $data, $condition);
      header("Location: " . EDIT_CATEGORY_ROUTE . $id);
    }

    public function styleProducts($categoryIds) {
      $UNSTYLED_ID = '11';
      $data = ['category_id' => $UNSTYLED_ID];
      $DB = $this->__productModel->getDB();
      $tableName = $this->__productModel->tableFill();
      $condition = "id IN ($categoryIds)";
      $DB->update($tableName, $data, $condition);
    }

    public function softDelete() {
      $data = [
        "is_deleted" => 1,
      ];
      $ids = implode(", ", $_POST['id']);
      $DB = $this->__categoryModel->getDB();
      $tableName = $this->__categoryModel->tableFill();
      $condition = "id IN ($ids)";
      $DB->update($tableName, $data, $condition);
      $this->styleProducts($ids);
      header("Location: " . CATEGORY_ROUTE . "1");
    }

    public function showFormAddCategory() {
      $this->_data['pathToPage'] = ADMIN_VIEW_DIR . '/categories/add';
      $this->_data['pageTitle'] = 'Thêm loại hàng';
      $this->_data["contentOfPage"] = [];
      $this->renderAdminLayout($this->_data);
    }

    public function initAdd() {
      $data = [
        "name" => $_POST['name'],
      ];
      $this->add($data);
    }

    public function add($data) {
      $DB = $this->__categoryModel->getDB();
      $tableName = $this->__categoryModel->tableFill();
      $DB->insert($tableName, $data);
      header("Location: " . CATEGORY_ROUTE . "1");
    }

    public function searchCategoriesByName() {
      $searchMessage = $_POST['search-box'];
      $wherePhrase = 
        " WHERE" . 
          " name LIKE '%$searchMessage%' AND" . 
          " is_deleted = 0";
      $this->index(1, $wherePhrase);
    }
  }
?>
