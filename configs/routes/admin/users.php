<?php 
  $routes['nguoi-dung-trang-(\d+)'] = 'admin/user/index/$1';
  $routes['chinh-sua-nguoi-dung-(\d+)'] = 'admin/user/edit/$1';
  $routes['cap-nhat-nguoi-dung-phia-admin-(\d+)'] = 'admin/user/update/$1';
  $routes['xoa-nguoi-dung'] = 'admin/user/delete';
  $routes['thong-tin-nguoi-dung-(\d+)'] = 'admin/user/info/$1';
  $routes['form-them-nguoi-dung'] = 'admin/user/showFormAddUser';
  $routes['them-nguoi-dung'] = 'admin/user/initAdd';
  $routes['tim-kiem-nguoi-dung'] = 'admin/user/searchUsersByNameAndEmail';
?>
