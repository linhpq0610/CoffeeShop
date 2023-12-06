<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">

              <div class="col-lg-8 position-relative">
                <h5 class="mb-3"><a href="<?= (SHOP_ROUTE . "1") ?>" class="text-body text-decoration-none"><i class="fas fa-long-arrow-alt-left me-2"></i>Tiếp tục mua sắm</a></h5>
                <hr>
                <?php
                if (count($bills) > 0) {
                  require CLIENT_COMPONENTS_DIR . '/bills.php';
                } else {
                  require CLIENT_COMPONENTS_DIR . '/noBill.php';
                }
                ?>

              </div>
              <div class="col-lg-4" style="height: 450px;">

                <div class="card text-white rounded-3 border-0 h-100 position-relative" style="background: linear-gradient(0, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(<?= IMAGES_URL; ?>/shopping-cart-full-item.avif) no-repeat; background-size: cover">
                  <a href="<?= CART_ROUTE; ?>" type="button" class="btn btn-info btn-block btn-sm w-50 position-absolute top-50 start-50 translate-middle">
                    <span>Xem giỏ hàng</span>
                  </a>
                </div>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>