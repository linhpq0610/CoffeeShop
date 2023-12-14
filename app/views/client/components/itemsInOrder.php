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
            <h5 class="text-truncate" style="width: 253px;"><?= $name; ?></h5>
            <div class="small mb-0 text-truncate" style="width: 230px;"><?= $description; ?></div>
          </div>
        </a>
        <div class="d-flex flex-row align-items-center">
          <div class="d-flex me-1" style="width: 120px;">
            <?php 
              if ($quantity > 1) {
            ?>
              <a href="<?=(DECREASE_QUANTITY_ROUTE . "$order_id-$product_id");?>" class="btn btn-link px-2 border-0 bg-transparent text-black">
                <i class="fas fa-minus"></i>
              </a>
            <?php } else { ?>
              <a href="#" class="btn btn-link px-2 border-0 bg-transparent text-black">
                <i class="fas fa-minus"></i>
              </a>
            <?php } ?>

            <input id="form1" min="1" name="quantity" value="<?= $quantity; ?>" type="number" class="form-control form-control-sm mx-1" />

            <a href="<?=(INCREASE_QUANTITY_ROUTE . "$order_id-$product_id");?>" class="btn btn-link px-2 border-0 bg-transparent text-black">
              <i class="fas fa-plus"></i>
            </a>
          </div>
          <div style="width: 100px;">
            <h6 class="mb-0"><?= ($this->formatNumber($price)); ?>₫</h6>
          </div>
          <div class="me-1">
            <h6 class="mb-0">
              =>
              <?php
              $subtotal = $quantity * $price;
              echo $this->formatNumber($subtotal);
              ?>₫
            </h6>
          </div>
          <a href="#!"><i class="fas fa-trash text-danger"></i></a>
        </div>
      </div>
    </div>
  </div>
<?php
endforeach;
?>