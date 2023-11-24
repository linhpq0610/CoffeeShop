<?php 
  require_once ADMIN_COMPONENTS_DIR . "/backBtn.php";
?>
<h4>Chi tiết đơn hàng</h4>

<div class="mt-3">
  <form action="<?=DELETE_PRODUCT_ROUTE;?>" method="post">
    <table class="table table-borderless table-responsive card-1">
      <thead>
        <tr class="border-bottom">
          <th>
            <span class="ml-1">STT</span>
          </th>
          <th>
            <span class="ml-2">Sản phẩm</span>
          </th>
          <th>
            <span class="ml-2">Giá</span>
          </th>
          <th>
            <span class="ml-2">Số lượng</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $orderNumber = 1;
          foreach ($ordersDetail as $orderDetail):
            extract($orderDetail);
        ?>
          <tr class="border-bottom">
            <td>
              <div class="p-2"><?=$orderNumber++;?></div>
            </td>
            <td>
              <a href="<?=(PRODUCT_INFO_ROUTE . $product_id);?>" class="p-2 d-flex flex-row align-items-center mb-2 text-decoration-none text-reset">
                <img
                  src="<?=(IMAGES_URL . "/" . $image);?>"
                  width="40"
                  class="me-3 rounded-circle"
                />
                <div class="d-flex flex-column ml-2">
                  <span class="d-block font-weight-bold"><?=$name;?></span>
                  <small class="text-muted text-truncate" style="width: 250px;"><?=$description;?></small>
                </div>
              </a>
            </td>
            <td>
              <div class="p-2"><?=($this->formatNumber($price));?>₫</div>
            </td>
            <td>
              <div class="p-2 d-flex flex-column"><?=$quantity;?></div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </form>
</div>

<?php 
  // require_once ADMIN_COMPONENTS_DIR . "/pagination.php";
?>
