<?php 
  if ($this->isSignedIn()) {
    require_once "commentForm.php";
  } else {
    require_once "requireSignIn.php";
  }
?>

<aside class="d-flex justify-content-between align-items-center mt-3 mb-0">
<h4 class="h6 mb-0"><?=$NUMBERS_OF_COMMENT;?> Bình luận</h4>
</aside>
<hr class="mt-0 mb-2">

<?php 
  foreach ($comments as $comment):
    extract($comment);
?>
  <article class="card bg-light mt-3">
    <header class="card-header border-0 bg-transparent d-flex align-items-center">
      <div>
      <img
        width="40px"
        src="<?=(IMAGES_URL . "/" . $image);?>"
        class="rounded-circle me-2"
      /><a class="fw-semibold text-decoration-none"><?=$user_name;?></a>
      <span class="ms-3 small text-muted">
        <i class="far fa-clock"></i>
        <?=$comment_date;?>
      </span>
      </div>
      <div class="dropdown ms-auto">
      <button class="btn border-0 text-decoration-none px-0 fs-5 text-black-50" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: transparent; color: #333">
        <i class="fas fa-ellipsis-v"></i>
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Báo cáo</a></li>
      </ul>
    </div>
    </header>
    <div class="card-body"><?=$content;?></div>
  </article>
<?php 
  endforeach;
?>