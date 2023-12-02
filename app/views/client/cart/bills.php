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
                foreach ($bills as $bill) :
                  extract($bill);
                ?>
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <a class="d-flex flex-row align-items-center text-decoration-none h5 mb-0">
                          Hóa đơn ngày
                          <?= $updated_at; ?>
                        </a>
                        <div class="d-flex flex-row align-items-center">
                          <div style="width: 120px;">
                            <h5 class="mb-0"><?= ($this->formatNumber($total)); ?>₫</h5>
                          </div>
                          <a href="#!"><i class="fas fa-trash text-danger"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                endforeach;
                ?>

              </div>
              <div class="col-lg-4">

                <div class="card text-white rounded-3 border-0">
                  <a href="<?= CART_ROUTE; ?>" type="button" class="btn btn-info btn-block btn-sm w-50 mx-auto">
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