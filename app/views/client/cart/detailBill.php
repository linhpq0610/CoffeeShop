<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">
              

              <div class="col-lg-8 position-relative">
              <?php
              require_once ADMIN_COMPONENTS_DIR . "/backBtn.php";
              ?>
              <hr>

                <?php
                foreach ($itemsInOrder as $item) :
                  extract($item);
                ?>

                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <a href="<?= (PRODUCT_DETAIL_ROUTE . $product_id); ?>" class="d-flex flex-row align-items-center text-decoration-none">
                          <div>
                            <img src="<?= (PRODUCTS_UPLOADS_URL . "/$image"); ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                          </div>
                          <div class="ms-3">
                            <h5 class="text-truncate" style="width: 250px;"><?= $name; ?></h5>
                            <p class="small mb-0 text-truncate" style="width: 250px;"><?= $description; ?></p>
                          </div>
                        </a>
                        <div class="d-flex flex-row align-items-center justify-content-start">
                          <div class="d-flex me-4" style="width: 100px;">
                            <input id="form1" min="0" name="quantity" value="<?= $quantity; ?>" type="number" class="form-control form-control-sm mx-2" readonly />
                          </div>
                          <div style="width: 100px;">
                            <h6 class="mb-0"><?= ($this->formatNumber($price)); ?>₫</h6>
                          </div>
                          <div>
                            <h6 class="mb-0">
                              =>
                              <?php
                              $subtotal = $quantity * $price;
                              echo $this->formatNumber($subtotal);
                              ?>
                              ₫
                            </h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                endforeach;
                ?>

              </div>
              <div class="col-lg-4">

                <div class="card bg-transparent rounded-3">
                  <div class="card-body">
                    <div class="">
                      <h6 class="mb-1">Người thanh toán: <?=$_SESSION['user']['name'];?></h6>
                      <h6 class="mb-0">Thanh toán lúc: <?=$datePurchased;?></h6>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between h6">
                      <h6 class="mb-2 fw-bold">Tổng:</h6>
                      <h6 class="mb-2"><?= ($this->formatNumber($total)); ?>₫</h6>
                    </div>


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