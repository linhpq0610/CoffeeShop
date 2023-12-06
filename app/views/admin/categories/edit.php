<?php 
  require_once ADMIN_COMPONENTS_DIR . "/backBtn.php";
  extract($formData);
  extract($category);
?>

<div class="container rounded" style="padding: 50px 0;">
  <div class="bg-white">
    <div class="row align-items-center">
      <div class="col-md-6 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <img width="250px" src="<?=(IMAGES_URL . "/" . DEFAULT_PRODUCT_IMAGE_NAME);?>" />
        </div>
      </div>

      <div class="col-md-6 border-right">
        <form action="<?=(UPDATE_CATEGORY_ROUTE . $id);?>" method="post" class="px-3 ps-lg-5 py-5 sign-up-form">
          <input type="text" hidden name="id" value="<?=$id;?>" />
          <div class='alert alert-danger border-0 p-0 text-center'>
            <?=$messageAlert;?>
          </div>
          <div class='alert alert-success border-0 p-0 text-center'>
            <?=$messageSuccess;?>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Chỉnh sửa loại hàng</h4>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Tên</label>
              <input
                type="text"
                class="form-control"
                placeholder="Cà phê hạt nguyên chất"
                name="name"
                value="<?=$name;?>"
              />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="mt-5 text-center">
            <button class="btn btn-primary profile-button" style="background-color: #333">
              Lưu
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Validatejs 0.13.1 -->
<script src="<?=PLUGINS_URL;?>/validatejs/validate.min.js"></script>
<script src="<?=FEATURES_URL;?>/Validator.js"></script>
<script>
  formValidator.setForm(".sign-up-form");
  const FORM = formValidator.getForm();
  formValidator.addField("name", FORM.elements["name"]);
  formValidator.start();
</script>
