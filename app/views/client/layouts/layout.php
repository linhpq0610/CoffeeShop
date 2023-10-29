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
    <link href="<?=CSS_URL;?>/bootstrap.min.css" rel="stylesheet" />
    <!-- Font awesome 6.0.0 -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
    <link href="<?=CSS_URL;?>/tiny-slider.css" rel="stylesheet" />
    <link href="<?=CSS_URL;?>/site-style.css" rel="stylesheet" />
  </head>

  <body>
    <?php 
      $this->render(CLIENT_COMPONENTS_DIR . "/header");

      echo "<div class='content'>";
      $this->render($pathToPage, $contentOfPage);
      echo "</div>";

      $this->render(CLIENT_COMPONENTS_DIR . "/footer");
    ?>

    <script src="<?=JS_URL;?>/bootstrap.bundle.min.js"></script>
    <script src="<?=JS_URL;?>/tiny-slider.js"></script>
    <script src="<?=JS_URL;?>/custom.js"></script>

    <script>
      // Active nav item
      const HREF = window.location.href;
      const PAGE = HREF.substr(HREF.lastIndexOf("/") + 1);
      if (PAGE) {
        const NAV_ITEM_ACTIVE = 
          document.querySelector(`.custom-navbar-nav li .nav-link[href="${PAGE}"]`);
        NAV_ITEM_ACTIVE?.parentNode.classList.add("active");
      } else {
        const NAV_ITEM_ACTIVE = 
          document.querySelector(`.custom-navbar-nav .nav-item`);
        NAV_ITEM_ACTIVE.classList.add("active");
      }

      const HEADER = document.querySelector("nav");
      const CONTENT = document.querySelector(".content");
      const HEADER_HEIGHT = HEADER.clientHeight;
      CONTENT.style.marginTop = HEADER_HEIGHT + 'px';
    </script>
  </body>
</html>