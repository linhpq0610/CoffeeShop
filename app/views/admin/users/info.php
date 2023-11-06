<?php 
  require_once ADMIN_COMPONENTS_DIR . "/backBtn.php";
?>

<div class="container rounded" style="padding: 50px 0;">
  <div class="bg-white">
    <form action="<?=(EDIT_USER_ROUTE . $id)?>" method="post" class="row align-items-center account-form" enctype="multipart/form-data">
      <div class="col-md-6 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <img
            class="rounded-circle"
            width="250px"
            id="avatar"
            src="<?=(IMAGES_URL . "/" . $image);?>"
          />
        </div>
      </div> 
      <div class="col-md-6 border-right">
        <div class="px-3 pe-lg-5 py-5">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Thông tin người dùng</h4>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Tên</label
              ><input
                readonly
                type="text"
                class="form-control"
                placeholder="Linh"
                value="<?=$name;?>"
                name="name"
              />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Email</label
              ><input
                readonly
                type="email"
                class="form-control"
                placeholder="example@gmail.com"
                value="<?=$email;?>"
                name="email"
              />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Mật khẩu</label
              ><input
                readonly type="password" class="form-control" value="<?=$password;?>" name="password" />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <label for="is_deleted" class="labels" style="width: unset"
              >Kích hoạt</label
            >
            <input
              id="is_deleted"
              type="checkbox"
              style="width: unset; width: 18px"
              disabled
              <?=($is_deleted ? "checked" : "");?>
            />
            <label for="is_admin" class="labels" style="width: unset">Quản trị</label>
            <input
              id="is_admin" 
              type="checkbox" 
              style="width: unset; width: 18px" 
              disabled
              <?=($is_admin ? "checked" : "");?>
            />
          </div>
          <div class="mt-5 text-center">
            <button
              class="btn btn-primary profile-button"
              style="background-color: #333"
            >
              Chỉnh sửa
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>