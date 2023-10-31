<?php 
  $routes['loai-hang-trang-(\d+)'] = 'admin/category/index/$1';
  $routes['cap-nhat-loai-hang-(\d+)'] = 'admin/category/update/$1';
  $routes['xoa-loai-hang'] = 'admin/category/delete';
  $routes['chinh-sua-loai-hang-(\d+)'] = 'admin/category/edit/$1';
  $routes['them-loai-hang'] = 'admin/category/initAdd';
  $routes['form-them-loai-hang'] = 'admin/category/showFormAddCategory';
  $routes['tim-kiem-loai-hang'] = 'admin/category/searchCategoriesByName';
?>
