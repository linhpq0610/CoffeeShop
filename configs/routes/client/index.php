<?php 
  $routes['trang-chu'] = 'client/home';
  $routes['gioi-thieu'] = 'client/about';
  require_once "product.php";
  require_once "account.php";
  $routes['lien-he'] = 'client/contact';
  $routes['gui-mail'] = 'client/contact/SendMail';
  require_once "orders.php";
?>
