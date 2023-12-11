<form action="<?php echo ADD_COMMENT_ROUTE . $product['id']; ?>" method="post" class="card bg-light comment-form">
  <header class="card-header border-0 bg-transparent">
    <img
      width="40px"
      src="<?=(USERS_UPLOADS_URL . "/" . $user['image']); ?>"
      class="rounded-circle me-2"
    />
    <a class="fw-semibold text-decoration-none"><?php echo $user['name']; ?></a>
  </header>
  <div class="card-body py-1">
    <div>
      <div>
        <textarea
          class="form-control form-control-sm border border-2 rounded-1"
          id="message"
          placeholder="Nhập bình luận tại đây"
          name="content"
          rows="4"
        ></textarea>
        <p class="field-message mb-0"></p>
      </div>
    </div>
  </div>
  <footer class="card-footer bg-transparent border-0 text-end">
    <button class="btn btn-link btn-sm me-2 text-decoration-none py-2 px-3 bg-secondary bg-gradient border-0">
      Hủy bỏ
    </button>
    <button
      type="submit"
      class="btn btn-primary btn-sm py-2 px-3 bg-dark"
    >
      Gửi
    </button>
  </footer>
</form>
