<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
      <div class="nav">
        <a class="nav-link" href="<?=ADMIN_ROUTE;?>">
          <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
          Bảng điều khiển
        </a>

        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
          <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
            Người dùng
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="<?=FORM_ADD_USER_ROUTE;?>">Thêm người dùng</a>
            <a class="nav-link" href=<?=(USER_ROUTE . "1");?>>Danh sách người dùng</a>
            <a class="nav-link" href=<?=(USER_DELETED_ROUTE . "1");?>>Người dùng đã xóa</a>
          </nav>
        </div>

        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
          <div class="sb-nav-link-icon"><i class="fas fa-th-large"></i></div>
          Loại hàng
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="<?=FORM_ADD_CATEGORY_ROUTE;?>">Thêm loại hàng</a>
            <a class="nav-link" href=<?=(CATEGORY_ROUTE . "1");?>>Danh sách loại hàng</a>
          </nav>
        </div>

        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
          <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
          Sản phẩm
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="<?=FORM_ADD_PRODUCT_ROUTE;?>">Thêm sản phẩm</a>
            <a class="nav-link" href=<?=(ADMIN_PRODUCT_ROUTE . "1");?>>Danh sách sản phẩm</a>
            <a class="nav-link" href=<?=(PRODUCT_DELETED_ROUTE . "1");?>>Sản phẩm đã xóa</a>
          </nav>
        </div>

        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts3">
          <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
            Thống kê
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="<?=(STATISTIC_COMMENT_ROUTE . "1");?>">Bình luận</a>
            <a class="nav-link" href=<?=STATISTIC_PRODUCT_ROUTE;?>>Sản phẩm</a>
          </nav>
        </div>
      </div>
    </div>
  </nav>
</div>
