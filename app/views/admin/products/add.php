<?php 
  require_once ADMIN_COMPONENTS_DIR . "/backBtn.php"; 
  extract($formData);
?>

<div class="container rounded" style="padding: 50px 0;">
  <div class="bg-white">
    <form action="<?= ADD_PRODUCT_ROUTE; ?>" method="post" class="row align-items-center edit-form" enctype="multipart/form-data">
      <div class="col-md-6 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <img class="rounded-circle" width="300px" id="avatar" src="<?= (PRODUCTS_UPLOADS_URL . "/" . DEFAULT_PRODUCT_IMAGE_NAME); ?>" />
          <input type="file" style="width: 200px;" class="mt-4" name="avatar" />
        </div>
      </div>
      <div class="col-md-6 border-right">
        <div class="px-3 pe-lg-5 py-5">
          <div class='alert alert-danger border-0 p-0 text-center'>
            <?=$messageAlert;?>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Thêm sản phẩm</h4>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Tên</label><input type="text" class="form-control" placeholder="VD: Cà phê Arabica 250g" name="name" value="<?=$name;?>" />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Mô tả</label><textarea class="form-control" cols="30" rows="4" name="description" placeholder="VD: Cà phê Arabica tinh khiết được trồng và chăm sóc tận tâm trên những thửa đất phủ đầy cỏ xanh tươi mát..."><?=$description;?></textarea>
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-6">
              <label class="labels">Giá</label><input type="number" class="form-control" name="price" placeholder="VD: 100000" value="<?=$price;?>" />
              <p class="field-message mb-0"></p>
            </div>
            <div class="col-md-6">
              <label class="labels">Giảm giá</label><input type="number" class="form-control" name="sale" placeholder="VD: 10" value="<?=$sale;?>" />
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label class="labels">Thể loại</label>
              <select type="text" class="form-control" name="category_id">
                <option value="">Chọn thể loại</option>
                <?php 
                  foreach ($categories as $category): 
                    extract($category); 
                  ?>
                  <option value="<?= $id; ?>"><?= $name; ?></option>
                <?php 
                  endforeach; 
                ?>
              </select>
              <p class="field-message mb-0"></p>
            </div>
          </div>
          <div class="mt-5 text-center">
            <button class="btn btn-primary profile-button" style="background-color: #333">Thêm</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<script src="<?= FEATURES_URL; ?>/Validator.js"></script>
<script src="<?= FEATURES_URL; ?>/loadImageFromInput.js"></script>

<script>
  loadImageFromInput("input[name='avatar']", "#avatar");
  formValidator.setForm(".edit-form");
  const FORM = formValidator.getForm();
  formValidator.addField("name", FORM.elements["name"]);
  formValidator.addField("description", FORM.elements["description"]);
  formValidator.addField("price", FORM.elements["price"]);
  formValidator.addField("sale", FORM.elements["sale"]);
  formValidator.addField("category_id", FORM.elements["category_id"]);

  const NEW_CONSTRAINTS = {
    name: {
      presence: {
        allowEmpty: false,
        message: "Vui lòng nhập tên",
      },
      format: {
        pattern: /^[a-zA-Z0-9\sàáạãảăắằẵặấầẩẫậđèéẹẻẽêếềểễệìíịỉĩòóọỏõôốồổỗộơớờởỡợùúụủũưứừửữựỳýỵỷỹ]+$/,
        message: "Vui lòng không nhập gì ngoài alphabet, ký tự trắng và số",
      },
    },
    description: {
      presence: {
        allowEmpty: false,
        message: "Vui lòng nhập mô tả",
      },
      length: {
        minimum: 50,
        tooShort: "Vui lòng nhập ít nhất 50 ký tự",
      },
    },
    price: {
      presence: {
        allowEmpty: false,
        message: "Vui lòng nhập đơn giá",
      },
      numericality: {
        greaterThan: 0,
        message: "Vui lòng nhập đơn giá lớn hơn 0",
      },
    },
    sale: {
      numericality: {
        greaterThanOrEqualTo: 0,
        lessThanOrEqualTo: 100,
        onlyInteger: true,
        message: "Vui lòng nhập giảm giá từ 0 đến 100",
      },
    },
    category_id: {
      presence: {
        allowEmpty: false,
        message: "Vui lòng chọn thể loại",
      },
    },
  };
  formValidator.addConstraint(NEW_CONSTRAINTS);
  formValidator.start();
</script>