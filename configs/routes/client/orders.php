<?php 
  $routes['gio-hang'] = 'client/order';
  $routes['chi-tiet-hoa-don-(\d+)'] = 'client/order/showBillDetail/$1';
  $routes['hoa-don'] = 'client/order/showBills';
  $routes['tang-so-luong-san-pham-(\d+)-(\d+)'] = 'client/order/increaseQuantityProduct/$1/$2';
  $routes['giam-so-luong-san-pham-(\d+)-(\d+)'] = 'client/order/decreaseQuantityProduct/$1/$2';
?>
