# PHP Laravel Quan Trắc Trà Vinh
+ Viết 1 Services đơn giản có trả về dữ liệu dạng JSON: https://www.youtube.com/watch?v=31DQQAWsAxE&list=RDCMUCvHX2bCZG2m9ddUhwxudKYA&start_radio=1&t=120
+ Dùng lệnh `php artisan make:controller 'tên file php cần tạo'` để tạo 1 file php
+ Sau đó thêm trong file `routes/web.php` các đường dẫn routes để chạy các file trên
+ Không nhất thiết chạy lệnh `php artisan serve` để tạo Web server localhost:8000 do chúng ta đã có Web server của Xampp hỗ trợ

### Tạo project mới
+ Cài đặt NodeJS: https://nodejs.org/en/download/
+ Cài đặt Composer: https://getcomposer.org/download/
+ Vào Webserver (với Xampp là `htdoc`) ==> Mở PowerShell hoặc CMD chạy lệnh sau `composer create-project laravel/laravel 'tên project'`
+ Cài các extension UI: chạy các lệnh sau:
```
    composer require laravel/ui
    php artisan ui bootstrap 
    npm install && npm run dev
    php artisan ui vue
    npm install && npm run dev
```
+ Trong file `routes/web.php`: thêm câu lệnh
```
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
```
+ Thêm file `.htaccess`: https://laravel.com/docs/5.0/configuration
+ Thêm file `index.php`

### Tạo connection DB PostgreSQL
+ Trong file `config/database.php`: chỉnh sửa thông tin kết nối DB như sau:
```
    ...
    'pgsql' => [
                'driver' => 'pgsql',
                'url' => env('DATABASE_URL'),
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '5432'),
                'database' => env('DB_DATABASE', 'travinhqt'),
                'username' => env('DB_USERNAME', 'postgres'),
                'password' => env('DB_PASSWORD', '0888365051'),
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
                'schema' => 'public',
                'sslmode' => 'prefer',
            ],
    ...
```
+ Trong file `.env` sửa đoạn code sau:
```
    DB_CONNECTION=pgsql (mysql)
    DB_HOST=127.0.0.1
    DB_PORT=5432 (3306)
    DB_DATABASE=travinhqt (laravel)
    DB_USERNAME=postgres (root)
    DB_PASSWORD=0888365051
```
+ Do sử dụng webserver là Xampp ==> cần config trong file `php/php.ini`, umcomment đoạn `;extension=pdo_pgsql`

### Đẩy WebApp vào Project
+ Cần 1 file chứa các config đường dẫn trong các thư mục JS ==> Thêm config services ở ngoài thẻ `webapp.blade.php`
+ Project WebApp TraVinh_QuanTrac: https://github.com/nguyenduclam/TraVinh_QuanTrac
+ Do dữ liệu trong Laravel luôn trả về dạng JSON ==> không cần sử dụng hàm `pg_fetch_assoc`, 
không cần chuyển sang dạng Array
+ Đẩy xong WebApp (done) ==> DOM chart trong thống kê không nhất thiết phải đầy đủ thông số và đầy đủ các trạm
(do có thể không có dữ liệu của trạm đó với thông số tương ứng)
