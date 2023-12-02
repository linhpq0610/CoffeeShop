<!-- sidebar + content -->
<div class="container" style="padding-top: 50px; padding-bottom: 50px">
  <div class="row">
    <!-- sidebar -->
    <div class="col-lg-3">
      <!-- Toggle button -->
      <button class="btn btn-outline-secondary mb-3 w-100 d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span>Hiển thị bộ lọc</span>
      </button>
      <!-- Collapsible wrapper -->
      <div class="collapse card d-lg-block mb-5" id="navbarSupportedContent">
        <div class="accordion" id="accordionPanelsStayOpenExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo" style="color: unset; background: unset">
                Danh mục
              </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
              <form 
                action="<?=SEARCH_ADMIN_PRODUCT_ROUTE_CLIENT_SIDE_BY_CATEGORY;?>" 
                method="post" 
                class="accordion-body text-end"
                id="filter-form"
              >
                <div class="text-start">
                  <div class="form-check">
                    <input 
                      class="form-check-input" 
                      type="checkbox" 
                      id="checkbox-all"
                      <?=($this->setCheckboxAllChecked());?>
                    />
                    <label class="form-check-label" for="checkbox-all">
                      Tất cả
                    </label>
                    <span class="badge bg-secondary float-end">
                      <?=$countOfAllProducts;?>
                    </span>
                  </div>
                  <hr class="my-1">
                  <?php
                    foreach ($categories as $category):
                      extract($category);
                  ?>
                    <div class="form-check">
                      <input 
                        class="form-check-input" 
                        type="checkbox" 
                        value="<?=$id;?>" 
                        id="id<?=$id;?>"
                        name="category_id[]"
                        <?=($this->setChecked($id));?>
                      />
                      <label class="form-check-label" for="id<?=$id;?>">
                        <?=$name;?>
                      </label>
                      <span class="badge bg-secondary float-end">
                        <?=$countOfProduct;?>
                      </span>
                    </div>
                  <?php 
                    endforeach;
                  ?>
                  <p class="field-message mb-0"></p>
                </div>
                <button class="btn btn-sm py-2 px-3 filter-submit-btn" type="submit">Lọc</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- sidebar -->
    <!-- content -->
    <div class="col-lg-9">
      <header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
        <form 
          class="search-box" 
          method="post" 
          action="<?=SEARCH_ADMIN_PRODUCT_ROUTE_CLIENT_SIDE;?>"
        >
          <input 
            type="text" 
            class="form-control rounded-0" 
            name="search-box" 
            placeholder="Tìm kiếm&hellip;"
            value="<?=($_POST['search-box'] ?? '');?>"
          />
        </form>
        <div class="ms-auto">
          <strong class="d-block py-2 fs-5"><?=$countOfProductsFound;?> sản phẩm</strong>
        </div>
      </header>

      <?php 
        foreach ($products as $product):
          extract($product);
      ?>
        <a href="<?=(PRODUCT_DETAIL_ROUTE . $id);?>">
          <div class="row justify-content-center mb-3">
            <div class="col-md-12">
              <div class="card shadow-0 border rounded-3">
                <div class="card-body">
                  <div class="row g-0">
                    <div class="col-xl-3 col-md-4 d-flex justify-content-center">
                      <div class="bg-image hover-zoom ripple rounded ripple-surface me-md-3 mb-3 mb-md-0">
                        <img src="<?=(PRODUCTS_UPLOADS_URL . "/$image");?>" style="max-width: 183px; max-height: 183px; object-fit: cover" />
                        <a href="#!">
                          <div class="hover-overlay">
                            <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 col-md-5 col-sm-7 pe-4">
                      <h5 class="text-truncate"><?=$name;?></h5>
                      <p class="text mb-4 mb-md-0 text-truncate-4" style="text-align: justify;">
                        <?=$description;?>
                      </p>
                    </div>
                    <div class="col-xl-3 col-md-3 col-sm-5">
                      <div class="d-flex flex-row align-items-center mb-1">
                        <h4 class="mb-1 me-1">
                          <?php 
                            $priceAfterSale = $price - ($price * $sale / 100);
                            echo $this->formatNumber($priceAfterSale);
                          ?>₫
                        </h4>
                        <?php
                          if ($sale > 0) {
                        ?>
                          <span class="text-danger">
                            <s><?=($this->formatNumber($price));?>₫</s>
                          </span>
                        <?php 
                          }
                        ?>
                      </div>
                      <h6 class="text-success">Miễn phí vận chuyển</h6>
                      <div class="mt-4">
                        <button class="btn btn-primary shadow-0" type="button" style="background: #333">Mua ngay</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
      
      <hr />

      <?php 
        require_once ADMIN_COMPONENTS_DIR . "/pagination.php";
      ?>
    </div>
  </div>
</div>

<script src="<?=FEATURES_URL?>/handleCheckboxes.js"></script>
<script>
  handleCheckboxes.setCheckboxAllElement("#checkbox-all");
  handleCheckboxes.setCheckboxElements("input[name='category_id[]']");
  handleCheckboxes.setSubmitBtn(".filter-submit-btn");
  handleCheckboxes.setCheckedQuantity();
  handleCheckboxes.start();
</script>
