<!-- Delete Modal HTML -->
<form 
  action="<?=SEND_EMAIL_FOR_USER_ROUTE;?>"
  method="post"
  class="modal fade"
  id="warningSkipCreatePassword"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <input type="email" hidden value="<?=$email;?>" name="email" />
  <input type="text" hidden value="<?=$userId;?>" name="user-id" />
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bỏ qua tạo mật khẩu</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div>
        <div class="modal-body">
          <p>Nếu bạn bỏ qua việc tạo mật khẩu, mật khẩu tài khoản sẽ được gửi qua mail của bạn. Tuy nhiên mật khẩu này rất khó nhớ.</p>
          <p>Bạn có chắc khi muốn thực hiện hành động này?</p>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-primary"
            data-bs-dismiss="modal"
            style="background: #6c757d"
          >
            Hủy bỏ
          </button>
          <button type="submit" class="btn btn-danger border-0" style="background: #dc3545">Tiếp tục</button>
        </div>
      </div>
    </div>
  </div>
</form>
