<h4>Danh sách sản phẩm bị xoá</h4>

<div class="mt-3">
  <div class="table-title border-bottom pb-3">
    <div class="row">
      <div class="col-sm-4">
        <form class="search-box" method="post" action="<?=SEARCH_ADMIN_PRODUCT_ROUTE_ADMIN_SIDE;?>">
          <input 
            type="text" 
            class="form-control" 
            name="search-box" 
            placeholder="Tìm kiếm&hellip;"
            value="<?=($_POST['search-box'] ?? '');?>"
          />
        </form>
      </div>
      <div class="col-sm-8 text-sm-end text-center mt-sm-0 mt-3">
        <a href="#restoreEmployeeModal" class="btn btn-primary disabled" data-bs-toggle="modal" id="delete-btn">
        <i class="fas fa-plus-circle"></i> <span>Khôi phục sản phẩm</span>
        </a>
        <a href="#deleteEmployeeModal" class="btn btn-danger disabled" data-bs-toggle="modal" id="delete-btn">
          <i class="fas fa-minus-circle"></i> <span>Xóa sản phẩm</span>
        </a>
      </div>
    </div>
  </div>

  <form action="<?=DELETE_PRODUCT_ROUTE;?>" method="post">
    <table class="table table-borderless table-responsive card-1">
      <thead>
        <tr class="border-bottom">
          <th>
            <span class="ml-1">
              <input class="form-check-input" type="checkbox" id="checkbox-all" />
            </span>
          </th>
          <th>
            <span class="ml-1">STT</span>
          </th>
          <th>
            <span class="ml-2">Tên</span>
          </th>
          <th>
            <span class="ml-2">Giá</span>
          </th>
          <th>
            <span class="ml-2">Lượt xem</span>
          </th>
          <th>
            <span class="ml-4">Hàng động</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $orderNumber = 1;
          foreach ($products as $product):
            extract($product);
        ?>
          <tr class="border-bottom">
            <td>
              <div class="p-2 ps-0">
                <input 
                  class="form-check-input" 
                  type="checkbox" 
                  name="id[]" 
                  value="<?=$id;?>" 
                />
              </div>
            </td>
            <td>
              <div class="p-2"><?=$orderNumber++;?></div>
            </td>
            <td>
              <div class="p-2 d-flex flex-row align-items-center mb-2">
                <img
                  src="<?=(IMAGES_URL . "/" . $image);?>"
                  width="40"
                  class="me-3 rounded-circle"
                />
                <div class="d-flex flex-column ml-2">
                  <span class="d-block font-weight-bold"><?=$name;?></span>
                  <small class="text-muted text-truncate" style="width: 250px;"><?=$description;?></small>
                </div>
              </div>
            </td>
            <td>
              <div class="p-2"><?=($this->formatNumber($price));?>₫</div>
            </td>
            <td>
              <div class="p-2 d-flex flex-column"><?=$view;?></div>
            </td>
            <td>
              <div class="p-2 icons">
                <a href="<?=(PRODUCT_INFO_ROUTE . $id);?>" class="edit text-decoration-none">
                  <i class="fas fa-info"></i>
                </a>

                <a 
                  href="#deleteEmployeeModal" 
                  class="delete" 
                  data-bs-toggle="modal" 
                  data-bs-original-title="Delete" 
                  data-bs-toggle="tooltip" 
                  onclick="handleSingleDelete.start(<?=$id;?>)"
                >
                  <i class="fa fa-trash text-danger"></i>
                </a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <?php 
      require_once ADMIN_COMPONENTS_DIR . "/deleteModal.php";
      require_once ADMIN_COMPONENTS_DIR . "/restoreModal.php";
    ?>
  </form>
</div>

<?php 
  require_once ADMIN_COMPONENTS_DIR . "/pagination.php";
?>
  
<script src="<?=FEATURES_URL?>/handleSingleDelete.js"></script>
<script src="<?=FEATURES_URL?>/handleCheckboxes.js"></script>

<script>
  handleCheckboxes.setCheckboxAllElement("#checkbox-all");
  handleCheckboxes.setCheckboxElements("input[name='id[]']");
  handleCheckboxes.setDeleteBtn("#delete-btn");
  handleCheckboxes.start();

  handleSingleDelete.setDeleteModal("#deleteEmployeeModal");
  handleSingleDelete.setDeleteModalDialog(".modal-dialog.modal-dialog-centered");
</script>
