<div class="container rounded" style="padding-top: 50px; padding-bottom: 50px">
  <div class="bg-white">
    <div class="row align-items-center">
      <div class="col-md-6 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <img width="250px" src="https://colorlib.com/etc/cf/ContactFrom_v12/images/img-01.png" />
        </div>
      </div>
      <form method="post" class="col-md-6 border-right contact-form">
        <div class="px-3 pe-lg-5 py-5">
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Tên</label><input type="text" class="form-control" placeholder="Linh" name="name" />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Email</label><input type="email" class="form-control" placeholder="example@gmail.com" name="email" />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Lời nhắn</label>
              <textarea name="" class="form-control" id="message" cols="30" rows="4" placeholder="Tôi gửi lời nhắn này với mục đích ..." name="message"></textarea>
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="mt-5 text-center">
            <button class="btn btn-primary profile-button" style="background-color: #333">Gửi</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<script src="<?= FEATURES_URL; ?>/Validator.js"></script>
<script>
  formValidator.setForm(".contact-form");
  const FORM = formValidator.getForm();
  formValidator.addField("name", FORM.elements["name"]);
  formValidator.addField("email", FORM.elements["email"]);
  formValidator.addField("message", FORM.elements["message"]);
  const MESSAGE_CONSTRAINT = {
    message: {
      presence: {
        allowEmpty: false,
        message: "Vui lòng nhập lời nhắn",
      },
      length: {
        minimum: 50,
        tooShort: "Vui lòng nhập ít nhất 50 ký tự",
      },
    }
  }
  formValidator.addConstraint(MESSAGE_CONSTRAINT);
  formValidator.start();
</script>
