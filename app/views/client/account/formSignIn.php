<div class="container rounded" style="padding-top: 50px; padding-bottom: 50px">
  <div class="bg-white">
    <div class="row align-items-center">
      <div class="col-md-6 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <img
            width="250px"
            src="<?=IMAGES_URL;?>/default-customer-image.webp"
          />
        </div>
      </div>
      <div class="col-md-6 border-right">
        <form action="<?=SIGN_IN_ROUTE;?>" method="post" class="px-3 pe-lg-5 py-5 sign-in-form">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Đăng nhập</h4>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Email</label
              ><input
                type="email"
                class="form-control"
                placeholder="VD: example@gmail.com"
                name="email"
              />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Mật khẩu</label
              ><input 
                type="password" 
                class="form-control" 
                name="password" 
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
              Đăng nhập
            </button>
          </div>
          <div class="text-center p-t-12">
            <span class="txt1">Quên</span>
            <a class="txt2" href="<?=FORGOT_PASSWORD_ROUTE;?>">mật khẩu?</a>
          </div>
          <div class="text-center p-t-136">
            <a class="txt2" href="<?=FORM_SIGN_UP_ROUTE;?>">
              Tạo tài khoản
              <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<script src="<?=FEATURES_URL;?>/Validator.js"></script>

<script>
  formValidator.setForm(".sign-in-form");
  const FORM = formValidator.getForm();
  formValidator.addField("email", FORM.elements["email"]);
  formValidator.addField("password", FORM.elements["password"]);
  formValidator.start();
</script>
