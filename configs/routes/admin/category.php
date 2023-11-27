<?php 
  $routes['danh-sach-loai-hang-da-xoa-trang-(\d+)'] = 'admin/category/showCategoriesDeleted/$1';
  $routes['loai-hang-trang-(\d+)'] = 'admin/category/index/$1';
  $routes['cap-nhat-loai-hang-(\d+)'] = 'admin/category/checkCategoryWhenUpdate/$1';
  $routes['xoa-loai-hang'] = 'admin/category/softDelete';
  $routes['chinh-sua-loai-hang-(\d+)'] = 'admin/category/edit/$1';
  $routes['form-them-loai-hang'] = 'admin/category/showFormAddCategory';
  $routes['them-loai-hang'] = 'admin/category/checkCategoryWhenAdd';
  $routes['tim-kiem-loai-hang-da-xoa'] = 'admin/category/searchCategoriesDeletedByName';
  $routes['tim-kiem-loai-hang'] = 'admin/category/searchCategoriesByName';
  $routes['xu-ly-hanh-dong-trong-danh-sach-loai-hang-da-xoa'] = 'admin/category/handleActionInCategoriesDeleted';
?>
