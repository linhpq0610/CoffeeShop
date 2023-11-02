# Hướng dẫn cài đặt và chạy CoffeeShop

## Mục lục

- [Bước 1: Cấu hình đường dẫn](#bước-1-cấu-hình-đường-dẫn)
- [Bước 2: Cấu hình URL](#bước-2-cấu-hình-url)
- [Bước 3: Cấu hình database](#bước-3-cấu-hình-database)
- [Bước 4: Chạy dự án](#bước-4-chạy-dự-án)

## Bước 1: Cấu hình đường dẫn

1. Truy cập file `configs/constants/directories.php`.
2. Tìm dòng sau đây:

   ```php
   define("ROOT_DIR", "D:\WorkSpace\Ampps\www\CoffeeShop/");
   ```

   Thay đổi thành đường dẫn trên máy của bạn:

   ```php
   define("ROOT_DIR", "ĐƯỜNG_DẪN_CỦA_BẠN");
   ```

## Bước 2: Cấu hình URL

1. Truy cập file `configs/constants/urls.php`.
2. Tìm dòng sau đây:

   ```php
    define("ROOT_URL", "http://localhost/CoffeeShop/");
   ```

   Thay đổi thành URL của bạn:

   ```php
   define("ROOT_URL", "URL_CỦA_BẠN");
   ```

## Bước 3: Cấu hình database

1. Truy cập file `configs/database.php`;
2. Thay đổi:
   ```php
    $config['database'] = [
      'host' => 'localhost',
      'userName' => 'root',
      'password' => 'mysql',
      'DBName' => 'CoffeeShop',
    ];
   ```
   Thành cấu hình database của bạn:
   ```php
    $config['database'] = [
      'host' => 'HOST_CỦA_BẠN',
      'userName' => 'TÊN_NGƯỜI_DÙNG_CỦA_BẠN',
      'password' => 'MẬT_KHẨU_CỦA_BẠN',
      'DBName' => 'TÊN_DATABASE_CỦA_BẠN',
    ];
   ```
3. Import file `CoffeeShop.sql` vào database của bạn.

## Bước 4: Chạy dự án

Bây giờ bạn đã cấu hình xong. Bạn có thể chạy dự án CoffeeShop trên máy tính của bạn.
