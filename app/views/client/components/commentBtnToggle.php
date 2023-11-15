<div
  class="offcanvas offcanvas-end w-50"
  tabindex="-1"
  id="offcanvas"
  data-bs-keyboard="false"
  data-bs-backdrop="true"
>
  <div class="offcanvas-header">
    <h5 class="offcanvas-title d-none d-sm-block" id="offcanvas">Bình luận</h5>

    <button
      type="button"
      class="btn-close text-reset"
      data-bs-dismiss="offcanvas"
      aria-label="Close"
    ></button>
  </div>
  <div class="offcanvas-body px-3">
    <?php 
      require_once CLIENT_COMPONENTS_DIR . "/comments.php";
    ?>
  </div>
</div>

<button
  class="btn border-0 text-decoration-none position-absolute end-0 bottom-0"
  data-bs-toggle="offcanvas"
  data-bs-target="#offcanvas"
  role="button"
>
  <i
    class="far fa-comments"
    data-bs-toggle="offcanvas"
    data-bs-target="#offcanvas"
  ></i>
  Bình luận
</button>
