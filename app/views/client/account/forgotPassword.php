<div class="container rounded" style="padding-top: 50px; padding-bottom: 50px">
  <div class="bg-white">
    <div class="row align-items-center">
      <div class="col-md-6 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <img
            width="250px"
            src="<?=(IMAGES_URL . "/" . DEFAULT_USER_IMAGE_NAME);?>"
          />
        </div>
      </div>
      <div class="col-md-6 border-right">
        <form action="<?=CHECK_EMAIL_ROUTE;?>" method="post" class="px-3 pe-lg-5 py-5 forgot-password-form">
          <div class='alert alert-danger border-0 p-0 text-center'>
            <?=$messageAlert;?>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Quên mật khẩu</h4>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Email</label
              ><input
                type="email"
                class="form-control"
                placeholder="VD: example@gmail.com"
                name="email"
                value="<?=$email;?>"
              />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="mt-5 text-center">
            <button
              class="btn btn-primary profile-button"
              style="background-color: #333"
              name="submit-btn"
            >
              Gửi
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
  formValidator.setForm(".forgot-password-form");
  const FORM = formValidator.getForm();
  formValidator.addField("email", FORM.elements["email"]);
  formValidator.start();
</script>
