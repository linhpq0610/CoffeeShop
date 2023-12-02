<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 Error</title>
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="<?=IMAGES_URL;?>/favicon1.png" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS 5.1.3 -->
    <link href="<?=PLUGINS_URL;?>/bootstrap/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body>
    <div class="d-flex align-items-center justify-content-center vh-100">
      <div class="text-center">
          <h1 class="display-1 fw-bold">500</h1>
          <p class="fs-3"> <span class="text-danger">Opps!</span> Xảy ra lỗi với database.</p>
          <p class="lead"><?=$message;?></p>
          <a onclick="goBack()" class="btn btn-primary" style="background: #333">Quay về</a>
      </div>
    </div>

    <script src="<?=FEATURES_URL;?>/goBack.js"></script>
  </body>
</html>