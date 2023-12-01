# Hướng dẫn cài đặt và chạy CoffeeShop

## Mục lục

- [Cấu hình đường dẫn](#bước-1-cấu-hình-đường-dẫn)
- [Cấu hình URL](#bước-2-cấu-hình-url)
- [Cấu hình database](#bước-3-cấu-hình-database)
- [Cài đặt thư viện](#bước-4-cài-đặt-thư-viện)
- [Chạy dự án](#bước-5-chạy-dự-án)

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

## Bước 4: Cài đặt thư viện

1. Tạo thư mục `libs` trong `public`
2. Giải nén `php-jwt.zip` vào thư mục `libs`
3. Tải thư viện Google API [tại đây](https://github.com/googleapis/google-api-php-client/releases/download/v2.15.1/google-api-php-client--PHP7.4.zip)
4. Đổi tên thư mục sau giải nén thành `google-api` và đặt vào thư mục `libs`.
5. Cuối cùng thư mục sẽ có cấu trúc như sau:

   ![Guide install libraries](guide-install-libraries.png)

## Bước 5: Chạy dự án

Bây giờ bạn đã cấu hình xong. Bạn có thể chạy dự án CoffeeShop trên máy tính của bạn.
