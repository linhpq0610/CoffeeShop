<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=(isset($pageTitle) ? $pageTitle : WEB_NAME);?></title>
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="<?=IMAGES_URL;?>/favicon1.png" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS 5.1.3 -->
    <link href="<?=PLUGINS_URL;?>/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <!-- Font awesome 6.0.0 -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
    <link href="<?=CLIENT_CSS_URL;?>/tiny-slider.css" rel="stylesheet" />
    <link href="<?=CLIENT_CSS_URL;?>/style.css" rel="stylesheet" />
  </head>

  <body>
    <?php 
      $this->render(CLIENT_COMPONENTS_DIR . "/header");

      echo "<div class='content'>";
      $this->render($pathToPage, $contentOfPage);
      echo "</div>";

      $this->render(CLIENT_COMPONENTS_DIR . "/footer");
    ?>

    <script src="<?=PLUGINS_URL;?>/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?=CLIENT_JS_URL;?>/tiny-slider.js"></script>
    <script src="<?=CLIENT_JS_URL;?>/custom.js"></script>
    <script src="<?=FEATURES_URL;?>/activeNavItem.js"></script>
  </body>
</html>
