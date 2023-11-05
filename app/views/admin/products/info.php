<?php 
  require_once ADMIN_COMPONENTS_DIR . "/backBtn.php";
?>

<div class="container rounded" style="padding: 50px 0;">
  <div class="bg-white">
    <form action="<?=(EDIT_PRODUCT_ROUTE . $id)?>" method="post" class="row align-items-center account-form" enctype="multipart/form-data">
      <div class="col-md-6 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <img
            class="rounded-circle"
            width="300px"
            id="avatar"
            src="<?=(IMAGES_URL . "/" . $image);?>"
          />
        </div>
      </div> 
      <div class="col-md-6 border-right">
        <div class="px-3 pe-lg-5 py-5">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Thông tin sản phẩm</h4>
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
              <label class="labels">Mô tả</label
              >
              <textarea readonly class="form-control" cols="30" rows="4" name="description"><?=$description;?></textarea>
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-6">
              <label class="labels">Giá</label
              ><input
                readonly type="number" class="form-control" value="<?=$price;?>" name="price" />
              <p class="field-message mb-0"></p>
            </div>
            <div class="col-md-6">
              <label class="labels">Giảm giá</label
              ><input
                readonly type="number" class="form-control" value="<?=$sale;?>" name="sale" />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-6">
              <label class="labels">Lượt xem</label
              ><input
                readonly type="number" class="form-control" value="<?=$view;?>" name="view" />
              <p class="field-message mb-0"></p>
            </div>
            <div class="col-md-6">
              <label class="labels">Ngày tạo</label
              ><input
                readonly type="datetime" class="form-control" value="<?=$entered_date;?>" name="entered_date" />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Thể loại</label
              ><input
                readonly type="text" class="form-control" value="<?=$categoryName;?>" name="categories" />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Đặc biệt</label
              >
              <input
                id="active"
                type="checkbox"
                style="width: unset; width: 18px"
                disabled
                <?=($special ? "checked" : "");?>
              />
              <p class="field-message mb-0"></p>
            </div>
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