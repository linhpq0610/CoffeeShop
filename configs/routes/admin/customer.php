<?php 
  $routes['khach-hang-trang-(\d+)'] = 'admin/customer/index/$1';
  $routes['chinh-sua-khach-hang-(\d+)'] = 'admin/customer/edit/$1';
  $routes['cap-nhat-khach-hang-phia-admin-(\d+)'] = 'admin/customer/update/$1';
  $routes['xoa-khach-hang'] = 'admin/customer/delete';
  $routes['thong-tin-khach-hang-(\d+)'] = 'admin/customer/info/$1';
  $routes['them-khach-hang'] = 'admin/customer/initAdd';
  $routes['form-them-khach-hang'] = 'admin/customer/showFormAddCustomer';
  $routes['tim-kiem-khach-hang'] = 'admin/customer/searchCustomersByNameAndEmail';
?>
