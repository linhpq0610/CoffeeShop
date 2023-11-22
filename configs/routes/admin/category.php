<?php 
  $routes['danh-sach-loai-hang-da-xoa-trang-(\d+)'] = 'admin/category/showCategoriesDeleted/$1';
  $routes['loai-hang-trang-(\d+)'] = 'admin/category/index/$1';
  $routes['cap-nhat-loai-hang-(\d+)'] = 'admin/category/update/$1';
  $routes['xoa-loai-hang'] = 'admin/category/softDelete';
  $routes['chinh-sua-loai-hang-(\d+)'] = 'admin/category/edit/$1';
  $routes['form-them-loai-hang'] = 'admin/category/showFormAddCategory';
  $routes['them-loai-hang'] = 'admin/category/initAdd';
  $routes['tim-kiem-loai-hang'] = 'admin/category/searchCategoriesByName';
?>
