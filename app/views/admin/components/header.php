<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <!-- Navbar Brand-->
  <a class="navbar-brand ps-3" href="<?=ADMIN_ROUTE?>">Admin</a>
  <!-- Sidebar Toggle-->
  <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
  <!-- Navbar Search-->
  <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    <!-- <div class="input-group">
      <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
      <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
    </div> -->
  </form>
  <!-- Navbar-->
  <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
    <li class="nav-item dropdown">
      <button class="btn nav-link bg-transparent dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
        <img src="<?=IMAGES_URL;?>/user.svg" />
      </button>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="<?=HOME_ROUTE;?>">Trang chủ</a></li>
        <li><a class="dropdown-item" href="<?=SIGN_OUT_ROUTE;?>">Đăng xuất</a></li>
      </ul>
    </li>
  </ul>
</nav>