<?php 
  extract($product);
?>
<!-- content -->
<section class="py-5">
  <div class="container">
    <div class="row gx-5">
      <aside class="col-lg-6">
        <div class="border rounded-4 mb-3 d-flex justify-content-center">
          <a 
            data-fslightbox="mygalley" 
            class="rounded-4" 
            target="_blank" data-
            type="image" 
            href="<?=(IMAGES_URL . "/" . $image);?>"
          >
            <img 
              style="max-width: 100%; max-height: 100vh; margin: auto;" 
              class="rounded-4 fit" 
              src="<?=(IMAGES_URL . "/" . $image);?>" 
            />
          </a>
        </div>
      </aside>
      <main class="col-lg-6">
        <div class="ps-lg-3">
          <h4 class="title text-dark">
            <?=$name;?>
          </h4>
          <div class="mb-3">
            <span class="h5">
              <?php 
                $priceAfterSale = $price - ($price * $sale / 100);
                echo $this->formatNumber($priceAfterSale);
              ?>₫
            </span>
            <?php
              if ($sale > 0) {
            ?>
              <span class="text-danger">
                <s><?=($this->formatNumber($price));?>₫</s>
              </span>
            <?php 
              }
            ?>
            <span class="text-muted">/mỗi sản phẩm</span>
          </div>

          <p style="text-align: justify;"><?=$description;?></p>
          <hr />

          <div class="row mb-4">
            <div class="col-md-4 col-6 mb-3">
              <label class="mb-2 d-block">Số lượng</label>
              <div class="input-group mb-3" style="width: 170px;">
                <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon1" data-mdb-ripple-color="dark">
                  <i class="fas fa-minus"></i>
                </button>
                <input type="text" class="form-control text-center border border-secondary" placeholder="14" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon2" data-mdb-ripple-color="dark">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
          <a href="#" class="btn btn-warning shadow-0"> Mua ngay </a>
          <a href="#" class="btn btn-secondary shadow-0"> <i class="me-1 fa fa-shopping-basket"></i> Thêm vào giỏ hàng </a>
        </div>
      </main>
    </div>
  </div>
</section>
<!-- content -->

<section class="bg-light border-top py-5">
  <div class="container position-relative">
    <div class="row gx-4">
        <?php 
          require_once CLIENT_COMPONENTS_DIR . "/returnPolicy.php";
          require_once CLIENT_COMPONENTS_DIR . "/relatedProducts.php";
        ?>
    </div>
    
    <?php 
      require_once CLIENT_COMPONENTS_DIR . "/commentBtnToggle.php";
    ?>
  </div>
</section>
