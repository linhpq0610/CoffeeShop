<?php 
  $routes['danh-sach-don-hang-trang-(\d+)'] = 'admin/order/index/$1';
  $routes['tim-kiem-don-hang'] = 'admin/order/searchOrdersByTotalAndDate';
  $routes['chi-tiet-don-hang-(\d+)-trang-(\d+)'] = 'admin/order/detail/$1/$2';
  $routes['xoa-don-hang-mem-phia-admin'] = 'admin/order/softDelete';
  $routes['danh-sach-don-hang-da-xoa-trang-(\d+)'] = 'admin/order/showOrdersDeleted/$1';
  $routes['xu-ly-hanh-dong-trong-danh-sach-don-hang-da-xoa'] = 'admin/order/handleActionInOrdersDeleted';
?>
