<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=(isset($pageTitle) ? $pageTitle : "Admin");?></title>
    <!-- Bootstrap CSS 5.1.3 -->
    <link href="<?=PLUGINS_URL;?>/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=ADMIN_CSS_URL;?>/style.css" rel="stylesheet" />
    <script 
      src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" 
      crossorigin="anonymous"
    ></script>
    <link rel="shortcut icon" href="<?=IMAGES_URL;?>/favicon1.png" />
  </head>

  <body class="sb-nav-fixed">
    <?=($this->render(ADMIN_COMPONENTS_DIR . "/header"));?>
        
    <div id="layoutSidenav">
        <?=($this->render(ADMIN_COMPONENTS_DIR . "/menu"));?>

        <div id="layoutSidenav_content">
          <div class="container-fluid p-4">
            <?=($this->render($pathToPage, $contentOfPage));?>
          </div>
        </div>
    </div>

    <script src="<?=PLUGINS_URL;?>/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?=ADMIN_JS_URL;?>/scripts.js"></script>
  </body>
</html>