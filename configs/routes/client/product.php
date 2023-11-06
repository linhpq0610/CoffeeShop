<?php 
  $routes['cua-hang-trang-(\d+)'] = 'client/product/index/$1';
  $routes['them-binh-luan-trong-san-pham-(\d+)'] = 'client/product/addCommentInProduct/$1';
  $routes['tim-kiem-san-pham-phia-client-bang-category-(\d?)'] = 
    'client/product/searchProductsByCategoryId/$1';
  $routes['tim-kiem-san-pham-phia-client'] = 'client/product/searchProductsByNameAndDescription';
  $routes['chi-tiet-san-pham-(\d+)'] = 'client/product/detail/$1';
?>
