<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email existed</title>
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
          <p class="fs-3"> <span class="text-danger">Opps!</span> Email đã tồn tại.</p>
          <p class="lead">
            Vui lòng dùng email khác.
          </p>
          <a onclick="goBack()" class="btn btn-primary" style="background: #333">Quay về</a>
      </div>
    </div>

    <script src="<?=FEATURES_URL;?>/goBack.js"></script>
  </body>
</html>