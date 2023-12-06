<?php
  require_once ADMIN_COMPONENTS_DIR . "/backBtn.php";
  extract($formData);
  extract($user);
?>

<div class="container rounded" style="padding: 50px 0;">
  <div class="bg-white">
    <form action="<?= (UPDATE_USER_ADMIN_ROUTE . $id) ?>" method="post" class="row align-items-center edit-form" enctype="multipart/form-data">
      <input type="text" hidden name="id" value="<?=$id;?>" />
      <div class="col-md-6 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <img
            class="rounded-circle"
            width="250px"
            id="avatar"
            src="<?= (USERS_UPLOADS_URL . "/$image"); ?>"
          />
          <input type="file" style="width: 200px;" class="mt-4" name="avatar" />
        </div>
      </div>
      <div class="col-md-6 border-right">
        <div class="px-3 pe-lg-5 py-5">
          <div class='alert alert-danger border-0 p-0 text-center'>
            <?=$messageAlert;?>
          </div>
          <div class='alert alert-success border-0 p-0 text-center'>
            <?=$messageSuccess;?>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Chỉnh sửa thông tin</h4>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Tên</label
              ><input
                type="text"
                class="form-control"
                placeholder="Linh"
                value="<?= $name; ?>"
                name="name"
              />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Email</label
              ><input
                type="email"
                class="form-control"
                placeholder="example@gmail.com"
                value="<?= $email; ?>"
                name="email"
              />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <label for="is_admin" class="labels" style="width: unset">
              Quản trị
            </label>
            <input 
              id="is_admin" 
              type="checkbox" 
              style="width: unset; width: 18px" 
              <?= ($is_admin ? "checked" : ""); ?>
              disabled
            />
          </div>
          <div class="mt-5 text-center">
            <button
              class="btn btn-primary profile-button"
              style="background-color: #333"
            >
              Lưu
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Validatejs 0.13.1 -->
<script src="<?=PLUGINS_URL;?>/validatejs/validate.min.js"></script>
<script src="<?= FEATURES_URL; ?>/Validator.js"></script>
<script src="<?= FEATURES_URL; ?>/loadImageFromInput.js"></script>

<script>
  loadImageFromInput("input[name='avatar']", "#avatar");
  formValidator.setForm(".edit-form");
  const FORM = formValidator.getForm();
  formValidator.addField("email", FORM.elements["email"]);
  formValidator.addField("password", FORM.elements["password"]);
  formValidator.start();
</script>