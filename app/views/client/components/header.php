<!-- Start Header/Navigation -->
<nav
  class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark fixed-top" style="background: #333 !important"
  arial-label="Furni navigation bar"
>
  <div class="container">
    <a class="navbar-brand" href="<?=HOME_ROUTE;?>"><?=WEB_NAME;?></a>

    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarsFurni"
      aria-controls="navbarsFurni"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsFurni">
      <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link" href="<?=HOME_ROUTE;?>">Trang chủ</a>
        </li>
        <li><a class="nav-link" href="<?=ABOUT_ROUTE;?>">Giới thiệu</a></li>
        <li><a class="nav-link" href="<?=(SHOP_ROUTE . "1");?>">Cửa hàng</a></li>
        <li><a class="nav-link" href="<?=CONTACT_ROUTE?>">Liên hệ</a></li>
        <?php 
          if ($this->isSignedIn()) { 
            $accountModel = $this->getModel("AccountModel");
            if ($accountModel->isAdmin()) {
        ?>
          <li><a class="nav-link" href="<?=ADMIN_ROUTE;?>">Admin</a></li>
        <?php 
            }
          } 
        ?>
      </ul>

      <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
        <li>
          <a class="nav-link" href="<?=CART_ROUTE;?>"
            ><img src="<?=IMAGES_URL;?>/cart.svg"
          /></a>
        </li>
        <li>
          <div class="dropdown">
            <button class="btn nav-link bg-transparent dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
              <img src="<?=IMAGES_URL;?>/user.svg" />
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
              <?php if ($this->isSignIng()) { ?>
                <li><a class="dropdown-item" href="<?=ACCOUNT_ROUTE;?>">Thông tin</a></li>
                <li><a class="dropdown-item" href="<?=SIGN_OUT_ROUTE;?>">Đăng xuất</a></li>
              <?php } else { ?>
                <li><a class="dropdown-item" href="<?=FORM_SIGN_IN_ROUTE;?>">Đăng nhập</a></li>
                <li><a class="dropdown-item" href="<?=FORM_SIGN_UP_ROUTE;?>">Đăng ký</a></li>
              <?php } ?>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Header/Navigation -->