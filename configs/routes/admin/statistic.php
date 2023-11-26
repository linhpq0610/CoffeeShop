<?php 
  $routes['tim-kiem-san-pham-trong-thong-ke-binh-luan'] = 'admin/statistic/searchProducts';
  $routes['thong-ke-hang-hoa'] = 'admin/statistic/showStatisticProducts';
  $routes['thong-ke-binh-luan-trang-(\d+)'] = 'admin/statistic/showStatisticComments/$1';
  $routes['danh-sach-binh-luan-(\d+)-trang-(\d+)'] = 'admin/statistic/showComments/$1/$2';
  $routes['tim-kiem-binh-luan-trong-san-pham-(\d+)'] = 
    'admin/statistic/searchCommentsInProduct/$1';
  $routes['xoa-binh-luan-trong-san-pham-(\d+)'] = 'admin/statistic/softDeleteCommentInProduct/$1';
  $routes['xem-bieu-do-san-pham'] = 'admin/statistic/showProductChart';
?>
