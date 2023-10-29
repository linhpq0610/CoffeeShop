<div class="clearfix row align-items-center">
  <div class="hint-text text-sm-start text-center col-lg-6 col-md-6 col-sm-12 mb-sm-0 mb-3">
    Đang hiển thị <b><?=$currentPage;?></b>
    /
    <b><?=$NUMBERS_OF_ROW;?></b>
  </div>
  <ul class="pagination text-sm-start text-center col-lg-6 col-md-6 col-sm-12 justify-content-center justify-content-sm-end">
    <?=$prevPageBtn;?>
    <!-- // TODO: show pages -->
    <!-- <li class="page-item"><a href="#" class="page-link">1</a></li>
    <li class="page-item"><a href="#" class="page-link">2</a></li>
    <li class="page-item active"><a href="#" class="page-link">3</a></li>
    <li class="page-item"><a href="#" class="page-link">4</a></li>
    <li class="page-item"><a href="#" class="page-link">5</a></li> -->
    <?=$nextPageBtn;?>
  </ul>
</div>
