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
        <form action="<?=AUTHENTICATION_WHEN_FORGOT_PASSWORD_ROUTE;?>" method="post" class="px-3 pe-lg-5 py-5 authentication-form">
          <div class='alert alert-danger border-0 p-0 text-center'>
            <?=$messageAlert;?>
          </div>
          <div class='alert alert-success border-0 p-0 text-center'>
            <?=$messageSuccess;?>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Xác thực</h4>
          </div>

          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Mã xác thực</label
              ><input
                type="number"
                class="form-control"
                placeholder="XXXXXX"
                name="code"
                value="<?=$code;?>"
              />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="mt-3 text-center">
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
  formValidator.setForm(".authentication-form");
  const FORM = formValidator.getForm();
  formValidator.addField("code", FORM.elements["code"]);
  const CODE_CONSTRAINT = {
    code: {
      presence: {
        allowEmpty: false,
        message: "Vui lòng nhập mã xác thực",
      },
      length: {
        maximum: 6,
        tooLong: "Vui lòng không nhập quá 6 chữ số",
      },
    },
  };
  formValidator.addConstraint(CODE_CONSTRAINT);
  formValidator.start();
</script>
