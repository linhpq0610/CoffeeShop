<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Error</title>
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="<?=IMAGES_URL;?>/favicon1.png" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS 5.1.3 -->
    <link href="<?=CSS_URL;?>/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body>
    <div class="d-flex align-items-center justify-content-center vh-100">
      <div class="text-center">
          <h1 class="display-1 fw-bold">404</h1>
          <p class="fs-3"> <span class="text-danger">Opps!</span> Không tìm thấy nội dung.</p>
          <p class="lead">
            URL của nội dung này đã bị thay đổi hoặc không còn tồn tại.
            <br>
            Nếu bạn đang lưu URL này, hãy thử truy cập lại từ trang chủ thay vì dùng URL đã lưu.
          </p>
          <a href="<?=ROOT_URL;?>" class="btn btn-primary" style="background: #333">Truy cập trang chủ</a>
      </div>
    </div>
  </body>
</html>