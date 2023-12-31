<h4>Danh sách người dùng</h4>

<div class="mt-3">
  <div class="table-title border-bottom pb-3">
    <div class="row">
      <div class="col-sm-4">
        <form class="search-box" method="post" action="<?= SEARCH_USER_ROUTE; ?>">
          <input
            type="text"
            class="form-control"
            name="search-box"
            placeholder="Tìm kiếm&hellip;"
            value="<?= ($_POST['search-box'] ?? ''); ?>"
          />
        </form>
      </div>
      <div class="col-sm-8 text-sm-end text-center mt-sm-0 mt-3">
        <a href="<?= FORM_ADD_USER_ROUTE; ?>" class="btn btn-success me-lg-2">
          <i class="fas fa-plus-circle"></i> <span>Thêm người dùng</span>
        </a>
        <a href="#deleteEmployeeModal" class="btn btn-danger disabled" data-bs-toggle="modal" id="delete-btn">
          <i class="fas fa-minus-circle"></i> <span>Xóa người dùng</span>
        </a>
      </div>
    </div>
  </div>

  <form action="<?= DELETE_USER_ROUTE; ?>" method="post">
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
            <span class="ml-2">Trạng thái</span>
          </th>
          <th>
            <span class="ml-2">Vai trò</span>
          </th>
          <th>
            <span class="ml-4">Hàng động</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
        $orderNumber = 1;
        foreach ($users as $user) :
          extract($user);
        ?>
          <tr class="border-bottom">
            <td>
              <div class="p-2 ps-0">
                <input
                  class="form-check-input"
                  type="checkbox"
                  name="id[]"
                  value="<?= $id; ?>"
                  <?= ($is_admin ? "disabled" : ""); ?>
                />
              </div>
            </td>
            <td>
              <div class="p-2"><?= $orderNumber++; ?></div>
            </td>
            <td>
              <div class="p-2 d-flex flex-row align-items-center mb-2">
                <img
                  src="<?=(USERS_UPLOADS_URL . "/$image");?>"
                  width="40"
                  class="me-3 rounded-circle"
                />
                <div class="d-flex flex-column ml-2">
                  <span class="d-block font-weight-bold"><?=$name;?></span>
                  <small class="text-muted"><?=$email;?></small>
                </div>
              </div>
            </td>
            <td>
              <div class="p-2">
                <span class="status text-success">&bull;</span> Tồn tại</td>
              </div>
            </td>
            <td>
              <div class="p-2 d-flex flex-column">
                <span>
                  <?= ($is_admin ? "Admin" : "Khách hàng"); ?>
                </span>
              </div>
            </td>
            <td>
              <div class="p-2 icons">
                <a href="<?=(USER_INFO_ROUTE . $id);?>" class="edit text-decoration-none">
                  <i class="fas fa-info"></i>
                </a>
                <a href="<?=(EDIT_USER_ROUTE . $id);?>" class="edit text-decoration-none">
                  <i class="fas fa-pen text-warning mx-2"></i>
                </a>
                <a
                  href="#deleteEmployeeModal"
                  class="delete <?= ($is_admin ? "delete-icon-disabled" : ""); ?>"
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
    ?>
  </form>
</div>

<?php
require_once ADMIN_COMPONENTS_DIR . "/pagination.php";
?>

<script src="<?= FEATURES_URL ?>/handleSingleDelete.js"></script>
<script src="<?= FEATURES_URL ?>/handleCheckboxes.js"></script>

<script>
  handleCheckboxes.setCheckboxAllElement("#checkbox-all");
  handleCheckboxes.setCheckboxElements("input[name='id[]']");
  handleCheckboxes.setDeleteBtn("#delete-btn");
  handleCheckboxes.start();

  handleSingleDelete.setDeleteModal("#deleteEmployeeModal");
  handleSingleDelete.setDeleteModalDialog(".modal-dialog.modal-dialog-centered");
</script>