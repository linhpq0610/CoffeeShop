<h4>Thống kê bình luận</h4>

<div class="mt-3">
  <div class="table-title border-bottom pb-3">
    <div class="row">
      <div class="col-sm-4">
        <form class="search-box" method="post" action="<?= SEARCH_PRODUCTS_IN_STATISTIC_COMMENT_ROUTE; ?>">
          <input 
            type="text" 
            class="form-control" 
            name="search-box" 
            placeholder="Tìm kiếm&hellip;"
            value="<?= ($_POST['search-box'] ?? ''); ?>"
          />
        </form>
      </div>
    </div>
  </div>

  <form action="<?= DELETE_PRODUCT_ROUTE; ?>" method="post">
    <table class="table table-borderless table-responsive card-1">
      <thead>
        <tr class="border-bottom">
          <th>
            <span class="ml-1">STT</span>
          </th>
          <th>
            <span class="ml-2">Tên hàng hóa</span>
          </th>
          <th>
            <span class="ml-2">Số bình luận</span>
          </th>
          <th>
            <span class="ml-2">Ngày mới nhất</span>
          </th>
          <th>
            <span class="ml-2">Ngày cũ nhất</span>
          </th>
          <th>
            <span class="ml-4">Hành động</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $orderNumber = 1;
        for ($i = 0; $i < count($statisticComments); $i++) {
          extract($statisticComments[$i]);
          extract($countOfComments[$i]);
        ?>
          <tr class="border-bottom">
            <td>
              <div class="p-2"><?= $orderNumber++; ?></div>
            </td>
            <td>
              <div class="p-2 d-flex flex-row align-items-center mb-2">
                <span class="d-block font-weight-bold"><?= $name; ?></span>
              </div>
            </td>
            <td>
              <div class="p-2"><?= $countOfComment; ?></div>
            </td>
            <td>
              <div class="p-2 d-flex flex-column"><?= $NEWEST_DATE; ?></div>
            </td>
            <td>
              <div class="p-2 d-flex flex-column"><?= $OLDEST_DATE; ?></div>
            </td>
            <td>
              <div class="p-2 icons">
                <a href="<?= (COMMENTS_ROUTE . $id . "-trang-1"); ?>" class="edit text-decoration-none">
                  <i class="fas fa-info ms-3"></i>
                </a>
              </div>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </form>
</div>

<?php 
require_once ADMIN_COMPONENTS_DIR . "/pagination.php";
?>