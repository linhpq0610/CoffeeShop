<!-- Delete Modal HTML -->
<div
  class="modal fade"
  id="deleteEmployeeModal"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xóa dữ liệu</h5>
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
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Hủy bỏ
          </button>
          <button type="submit" class="btn btn-danger">Xóa</button>
        </div>
      </div>
    </div>
  </div>
</div>
