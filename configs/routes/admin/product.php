<?php 
   $routes['danh-sach-san-pham-da-xoa-trang-(\d+)'] = 'admin/product/showProductsDeleted/$1';
   $routes['san-pham-phia-admin-trang-(\d+)'] = 'admin/product/index/$1';
   $routes['cap-nhat-san-pham-(\d+)'] = 'admin/product/update/$1';
   $routes['xoa-san-pham'] = 'admin/product/softDelete';
   $routes['chinh-sua-san-pham-(\d+)'] = 'admin/product/edit/$1';
   $routes['thong-tin-san-pham-(\d+)'] = 'admin/product/info/$1';
   $routes['form-them-san-pham'] = 'admin/product/showFormAddProduct';
   $routes['them-san-pham'] = 'admin/product/initAdd';
   $routes['tim-kiem-san-pham-da-xoa-phia-admin'] = 'admin/product/searchProductsDeletedByNameAndDescription';
   $routes['tim-kiem-san-pham-phia-admin'] = 'admin/product/searchProductsByNameAndDescription'; 
?>
