<h4>Thống kê sản phẩm</h4>

<div class="mt-3">
  <form action="<?=DELETE_PRODUCT_ROUTE;?>" method="post">
    <table class="table table-borderless table-responsive card-1">
      <thead>
        <tr class="border-bottom">
          <th>
            <span class="ml-1">STT</span>
          </th>
          <th>
            <span class="ml-2">Tên</span>
          </th>
          <th>
            <span class="ml-2">Số hàng hóa</span>
          </th>
          <th>
            <span class="ml-2">Giá trung bình</span>
          </th>
          <th>
            <span class="ml-2">Giá thấp nhất</span>
          </th>
          <th>
            <span class="ml-2">Giá cao nhất</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $orderNumber = 1;
          for ($i = 0; $i < count($statisticProducts); $i++) {
            extract($statisticProducts[$i]);
            extract($countOfProducts[$i]);
        ?>
          <tr class="border-bottom">
            <td>
              <div class="p-2"><?=$orderNumber++;?></div>
            </td>
            <td>
              <div class="p-2 d-flex flex-row align-items-center mb-2">
                <span class="d-block font-weight-bold"><?=$name;?></span>
              </div>
            </td>
            <td>
              <div class="p-2"><?=$countOfProduct;?></div>
            </td>
            <td>
              <div class="p-2 d-flex flex-column"><?=($this->formatNumber($AVG_PRICE));?>₫</div>
            </td>
            <td>
              <div class="p-2 d-flex flex-column"><?=($this->formatNumber($MIN_PRICE));?>₫</div>
            </td>
            <td>
              <div class="p-2 d-flex flex-column"><?=($this->formatNumber($MAX_PRICE));?>₫</div>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </form>

  <a href='<?=SHOW_PRODUCT_CHART_ROUTE;?>' class='page-link d-inline-block text-black'>Xem biểu đồ</a>
</div>
