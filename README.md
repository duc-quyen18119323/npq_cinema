npq_cinema/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AdminAuthController.php
│   │   │   │   ├── BookingAdminController.php
│   │   │   │   └── ... (các controller quản trị khác)
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   └── RegisteredUserController.php
│   │   │   ├── HomeController.php
│   │   │   └── ... (các controller khác)
│   │   └── Middleware/
│   ├── Models/
│   │   ├── Admin.php
│   │   ├── Movie.php
│   │   └── ... (User, Booking, ...)
│   └── ... (Providers, ...)
├── bootstrap/
├── config/
│   └── ... (auth.php, admin_auth.php, ...)
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── ...
├── public/
│   ├── storage/
│   └── ... (index.php, ảnh poster,...)
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   │   ├── bookings/
│   │   │   ├── movies/
│   │   │   ├── payments/
│   │   │   ├── rooms/
│   │   │   ├── seats/
│   │   │   └── showtimes/
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── ...
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   └── guest.blade.php
│   │   ├── home.blade.php
│   │   └── ... (các view khác)
│   └── lang/
├── routes/
│   ├── web.php
│   └── ... (api.php nếu có)
├── storage/
├── tests/
├── vendor/
├── .env
├── artisan
├── composer.json
├── package.json
├── tailwind.config.js
├── vite.config.js
└── ...

Backend: Laravel (PHP), MySQL, Composer, Eloquent, Artisan
Frontend: Blade, Tailwind CSS, Vite, NPM

1.Yêu cầu hệ thống
PHP >= 8.x
Composer (trình quản lý package PHP)
MySQL/MariaDB (hoặc SQLite)
Node.js & NPM (để build frontend)
2.Các bước cài đặt
composer install //Cài đặt package PHP
npm install //Cài đặt package js
cp .env.example .env  //Tạo file cấu hình môi trường
Mở file .env và chỉnh sửa thông tin database cho phù hợp
php artisan key:generate //Tạo khóa
Tạo database (nếu chưa có)//Vào MySQL và tạo database trùng với tên đã khai báo ở .env.
php artisan migrate --seed//Chạy migrate và seed dữ liệu mẫu
npm run build
# hoặc để phát triển:
npm run dev
php artisan serve //khởi động laravel