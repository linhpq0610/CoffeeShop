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
        <div class="d-flex flex-row align-items-center">
          <div class="d-flex me-4" style="width: 140px;">
            <button class="btn btn-link px-2 border-0 bg-transparent text-black" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
              <i class="fas fa-minus"></i>
            </button>

            <input id="form1" min="0" name="quantity" value="<?= $quantity; ?>" type="number" class="form-control form-control-sm mx-2" />

            <button class="btn btn-link px-2 border-0 bg-transparent text-black" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          <div style="width: 120px;">
            <h5 class="mb-0"><?= ($this->formatNumber($price)); ?>₫</h5>
          </div>
          <a href="#!"><i class="fas fa-trash text-danger"></i></a>
        </div>
      </div>
    </div>
  </div>
<?php
endforeach;
?>