<?php 
  require_once ADMIN_COMPONENTS_DIR . "/backBtn.php";
?>
<h4>Danh sách bình luận đã xóa</h4>

<div class="mt-3">
  <div class="table-title border-bottom pb-3">
    <div class="row">
      <div class="col-sm-4">
        <form class="search-box" method="post" action="<?=(SEARCH_COMMENTS_IN_PRODUCT_ROUTE . $productId);?>">
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
        <label for="delete" class="btn btn-danger disabled" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal" id="delete-btn">
          <i class="fas fa-minus-circle"></i> <span>Xóa bình luận</span>
        </label>
      </div>
    </div>
  </div>

  <form action="<?=(HANDLE_ACTION_COMMENTS_DELETED_ROUTE . $productId);?>" method="post">
    <input type="radio" hidden name="action" id="restore" value="restore" />
    <input type="radio" hidden name="action" id="delete" value="delete" />
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
            <span class="ml-2">Khách hàng</span>
          </th>
          <th>
            <span class="ml-2">Nội dung</span>
          </th>
          <th>
            <span class="ml-2">Ngày bình luận</span>
          </th>
          <th>
            <span class="ml-4">Hành động</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $orderNumber = 1;
          foreach ($comments as $comment):
            extract($comment);
        ?>
          <tr class="border-bottom">
            <td>
              <span class="ml-1">
                <input 
                  class="form-check-input" 
                  type="checkbox" 
                  name="id[]" 
                  value="<?=$id;?>" 
                />
              </span>
            </td>
            <td>
              <div class="p-2"><?=$orderNumber++;?></div>
            </td>
            <td>
              <a href="<?=(USER_INFO_ROUTE . $user_id);?>" class="p-2 d-flex flex-row align-items-center mb-2 text-decoration-none text-reset">
                <img
                  src="<?=(IMAGES_URL . "/" . $image);?>"
                  width="40"
                  class="me-3 rounded-circle"
                />
                <div class="d-flex flex-column ml-2">
                  <span class="d-block font-weight-bold"><?=$user_name;?></span>
                  <small class="text-muted"><?=$email;?></small>
                </div>
              </a>
            </td>
            <td>
              <div class="p-2 d-flex flex-row align-items-center mb-2" href="#commentContentModal" data-bs-toggle="modal" data-bs-original-title="Delete" data-bs-toggle="tooltip" style="cursor: pointer;">
                <span class="d-block font-weight-bold text-truncate" style="width: 300px" onclick="getCommentContent.start(this);"><?=$content;?></span>
              </div>
            </td>
            <td>
              <div class="p-2"><?=$commented_date;?></div>
            </td>
            <td>
              <div class="p-2 icons">
                <label for="restore" class="restore mx-2" data-bs-toggle="modal" data-bs-target="#restoreEmployeeModal" id="restore-btn" onclick="handleSingleRestore.start(<?= $id; ?>)" style="cursor: pointer">
                  <i class="fas fa-undo text-secondary"></i>
                </label>
                
                <label for="delete" class="delete <?= ($is_admin ? "delete-icon-disabled" : ""); ?>" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal" id="delete-btn" onclick="handleSingleDelete.start(<?= $id; ?>)" style="cursor: pointer">
                  <i class="fa fa-trash text-danger"></i>
                </label>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <?php require_once ADMIN_COMPONENTS_DIR . "/deleteModal.php"; ?>
    <?php require_once ADMIN_COMPONENTS_DIR . "/restoreModal.php"; ?>
    <?php require_once ADMIN_COMPONENTS_DIR . "/commentModal.php"; ?>
  </form>
</div>

<?php require_once ADMIN_COMPONENTS_DIR . "/pagination.php"; ?>

<script src="<?= FEATURES_URL ?>/handleSingleDelete.js"></script>
<script src="<?= FEATURES_URL ?>/handleCheckboxes.js"></script>
<script src="<?= FEATURES_URL ?>/handleSingleRestore.js"></script>
<script src="<?=FEATURES_URL?>/getCommentContent.js"></script>

<script>
  handleCheckboxes.setCheckboxAllElement("#checkbox-all");
  handleCheckboxes.setCheckboxElements("input[name='id[]']");
  handleCheckboxes.setDeleteBtn("#delete-btn");
  handleCheckboxes.setDeleteBtn("#restore-btn");
  handleCheckboxes.start();

  handleSingleDelete.setDeleteModal("#deleteEmployeeModal");
  handleSingleDelete.setDeleteModalDialog(".modal-dialog.modal-dialog-centered");
  handleSingleRestore.setRestoreModal("#restoreEmployeeModal");
  handleSingleRestore.setRestoreModalDialog(".modal-dialog.modal-dialog-centered");
  getCommentContent.setCommentModalBody("#commentContentModal .modal-body p");
</script>
