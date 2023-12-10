<?php 
  $routes['xu-ly-dang-nhap-voi-google'] = 'client/account/handleSignInWithGoogle';
  $routes['kiem-tra-nguoi-dung-khi-quen-mat-khau'] = 'client/account/checkUserWhenForgotPassword';
  $routes['quen-mat-khau'] = 'client/account/showFormForgotPassword';
  $routes['hien-thi-form-thay-doi-mat-khau'] = 'client/account/showFormChangePassword';
  $routes['thay-doi-mat-khau'] = 'client/account/changePassword';
  $routes['tao-mat-khau-moi-cho-nguoi-dung-(\d+)'] = 'client/account/setNewPassword/$1';
  $routes['tao-mat-khau-(\d+)'] = 'client/account/createNewPassword/$1';
  $routes['xoa-tai-khoan-phia-client-(\d+)'] = 'client/account/softDelete/$1';
  $routes['tai-khoan'] = 'client/account';
  $routes['tu-dong-dang-nhap'] = 'client/account/autoSignIn';
  $routes['xu-ly-dang-nhap'] = 'client/account/checkSignIn';
  $routes['dang-nhap'] = 'client/account/showFormSignIn';
  $routes['xu-ly-dang-ky'] = 'client/account/checkSignUp';
  $routes['dang-ky'] = 'client/account/showFormSignUp';
  $routes['dang-xuat'] = 'client/account/signOut';
  $routes['cap-nhat-nguoi-dung-(\d+)'] = 'client/account/checkWhenUpdate/$1';
  $routes['gui-mat-khau-cho-nguoi-dung'] = 'client/account/sendPasswordForUser';
  $routes['hien-thi-form-xac-thuc-nguoi-dung-doi-mat-khau'] = 'client/account/showFormAuthentication';
  $routes['xac-thuc-nguoi-dung-doi-mat-khau'] = 'client/account/authenticationWhenForgotPassword';
?>
