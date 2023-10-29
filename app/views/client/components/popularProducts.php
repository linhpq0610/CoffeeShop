<!-- Start Product Section -->
<div class="product-section">
  <div class="container">
    <div class="row">
      <h2 class="mb-4 section-title">Sản phẩm nổi bật</h2>
      
      <?php 
        foreach ($popularProducts as $product): 
        extract($product);
      ?>
        <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
          <a class="product-item" href="<?=(PRODUCT_DETAIL_ROUTE . $id);?>">
            <img
              src="<?=(IMAGES_URL . "/" . $image);?>"
              class="img-fluid product-thumbnail"
            />
            <h3 class="product-title"><?=$name;?></h3>
            <strong class="product-price"><?=($this->formatNumber($price));?>₫</strong>

            <span class="icon-cross">
              <img src="<?=IMAGES_URL;?>/cross.svg" class="img-fluid" />
            </span>
          </a>
        </div>
      <?php endforeach; ?>

      <p class="text-center mt-4"><a href="<?=(SHOP_ROUTE . "1");?>" class="btn">Khám phá ngay</a></p>
    </div>
  </div>
</div>
<!-- End Product Section -->