<?php
foreach ($bills as $bill) :
  extract($bill);
?>
  <div class="card mb-3">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <a href="<?= (BILL_DETAIL_ROUTE . $id); ?>" class="d-flex flex-row align-items-center text-decoration-none h5 mb-0">
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