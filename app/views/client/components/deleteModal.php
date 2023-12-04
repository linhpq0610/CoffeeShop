<!-- Delete Modal HTML -->
<form 
  action="<?=(DELETE_USER_CLIENT_SIDE . $id);?>"
  method="post"
  class="modal fade"
  id="deleteEmployeeModal"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xóa tài khoản</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div>
        <div class="modal-body">
          <p>Bạn có chắc khi muốn thực hiện hành động này?</p>
          <p class="text-warning">
            <small>Hành động này không thể khôi phục.</small>
          </p>
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
          <button type="submit" class="btn btn-danger border-0" style="background: #dc3545">Xóa</button>
        </div>
      </div>
    </div>
  </div>
</form>
