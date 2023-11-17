<div class="col-lg-4">
  <div class="px-0 border rounded-2 shadow-0">
    <div class="card">
      <div class="card-body text-center">
        <h5 class="card-title text-start">Sản phẩm tương tự</h5>
        <div class="text-start">
          <?php
          foreach ($productsRelated as $productRelated) :
            extract($productRelated);
          ?>
            <div class="d-flex align-items-center mb-3">
              <a href="<?= (PRODUCT_DETAIL_ROUTE . $id); ?>" class="me-3">
                <img src="<?= (IMAGES_URL . "/" . $image); ?>" style="max-width: 96px; height: 96px; object-fit: cover" class="img-md img-thumbnail" />
              </a>
              <div class="info">
                <a href="<?= (PRODUCT_DETAIL_ROUTE . $id); ?>" class="nav-link mb-1 p-0 text-truncate-2 text-black fs-6">
                  <?= $name; ?>
                </a>
                <strong class="text-dark">
                  <?php
                  $priceAfterSale = $price - ($price * $sale / 100);
                  echo $this->formatNumber($priceAfterSale);
                  ?>₫
                </strong>
                <?php
                if ($sale > 0) {
                ?>
                  <span class="text-danger">
                    <s><?= ($this->formatNumber($price)); ?>₫</s>
                  </span>
                <?php
                }
                ?>
              </div>
            </div>
          <?php
          endforeach;
          ?>
        </div>

        <?php
        $NUMBER_OF_PRODUCTS_RELATED_SHOULD_SHOW = 8;
        if (count($productsRelated) > $NUMBER_OF_PRODUCTS_RELATED_SHOULD_SHOW) {
        ?>
          <a href="<?= (SEARCH_ADMIN_PRODUCT_ROUTE_CLIENT_SIDE_BY_CATEGORY . $category_id); ?>" class="btn">
            Xem thêm
          </a>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>