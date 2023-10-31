<?php 
  $routes['quen-mat-khau'] = 'client/account/forgotPassword';
  $routes['kiem-tra-email'] = 'client/account/checkEmail';
  $routes['thay-doi-mat-khau'] = 'client/account/changePassword';
  $routes['hien-thi-form-thay-doi-mat-khau'] = 'client/account/showFormChangePassword';
  $routes['tao-mat-khau-moi-cho-nguoi-dung-(\d+)'] = 'client/account/setNewPassword/$1';
  $routes['tai-khoan'] = 'client/account';
  $routes['xu-ly-dang-nhap'] = 'client/account/checkSignIn';
  $routes['dang-nhap'] = 'client/account/loadFormSignIn';
  $routes['dang-ky'] = 'client/account/loadFormSignUp';
  $routes['xu-ly-dang-ky'] = 'client/account/checkSignUp';
  $routes['dang-xuat'] = 'client/account/signOut';
  $routes['cap-nhat-khach-hang-(\d+)'] = 'client/account/update/$1';
?>
