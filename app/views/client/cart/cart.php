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
                if ($this->isSignedIn()) {
                  require CLIENT_COMPONENTS_DIR . '/itemsInOrder.php';
                } else {
                  require CLIENT_COMPONENTS_DIR . '/emptyCart.php';
                }
                ?>

              </div>
              <div class="col-lg-4">

                <div class="card bg-primary text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">Chi tiết thẻ</h5>
                    </div>

                    <p class="h6 mb-2">Loại thẻ</p>
                    <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-visa fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-amex fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

                    <form class="mt-4">
                      <div class="form-outline form-white mb-4 h6">
                        <label class="form-label" for="typeName">Tên chủ thẻ</label>
                        <input type="text" id="typeName" class="form-control form-control-lg" siez="17" placeholder="Tên chủ thẻ" />
                      </div>

                      <div class="form-outline form-white mb-4 h6">
                        <label class="form-label" for="typeText">Số thẻ</label>
                        <input type="text" id="typeText" class="form-control form-control-lg" siez="17" placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                      </div>

                      <!-- <div class="row mb-4">
                        <div class="col-md-6">
                          <div class="form-outline form-white">
                            <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                            <label class="form-label" for="typeExp">Expiration</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-outline form-white">
                            <input type="password" id="typeText" class="form-control form-control-lg" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                            <label class="form-label" for="typeText">Cvv</label>
                          </div>
                        </div>
                      </div> -->

                    </form>

                    <hr class="my-4">

                    <!-- <div class="d-flex justify-content-between">
                      <p class="mb-2">Subtotal</p>
                      <p class="mb-2">$4798.00</p>
                    </div> -->

                    <!-- <div class="d-flex justify-content-between">
                      <p class="mb-2">Shipping</p>
                      <p class="mb-2">$20.00</p>
                    </div> -->

                    <div class="d-flex justify-content-between mb-4 h6">
                      <p class="mb-2">Thành tiền</p>
                      <p class="mb-2"><?= ($this->formatNumber($total)); ?>₫</p>
                    </div>

                    <button type="button" class="btn btn-info btn-block btn-lg">
                      <div class="d-flex justify-content-between">
                        <span>Thanh toán <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                      </div>
                    </button>

                  </div>
                </div>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>