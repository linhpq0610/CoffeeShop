<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=(isset($pageTitle) ? $pageTitle : "Admin");?></title>
    <!-- <link 
    href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" 
    rel="stylesheet" 
    /> -->
    <!-- Bootstrap CSS 5.1.3 -->
    <link href="<?=CSS_URL;?>/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=CSS_URL;?>/admin-style.css" rel="stylesheet" />
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

    <script src="<?=JS_URL;?>/bootstrap.bundle.min.js"></script>
    <script src="<?=JS_URL;?>/scripts.js"></script>
  </body>
</html>