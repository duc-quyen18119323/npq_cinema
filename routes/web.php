<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisteredUserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/history', [ProfileController::class, 'bookingHistory'])->name('profile.history');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route đặt vé cho user
    Route::get('/bookings/create', [App\Http\Controllers\BookingController::class, 'create'])->name('bookings.create');
    // Có thể thêm các route bookings khác nếu muốn
});

// Route resource cho bookings cho user thường
Route::get('seats/show', [App\Http\Controllers\BookingController::class, 'seatsByShowtime']);
Route::resource('bookings', App\Http\Controllers\BookingController::class)->only(['create', 'store', 'show', 'destroy']);

// Route chuyển hướng đến trang thanh toán (giả định PaymentController@create)
Route::get('payments/create', [App\Http\Controllers\PaymentController::class, 'create'])->name('payments.create');

use App\Http\Controllers\Admin\AdminAuthController;

// Trang đăng nhập admin
Route::get('/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::resource('movies', App\Http\Controllers\Admin\MovieAdminController::class);
    Route::resource('rooms', App\Http\Controllers\Admin\RoomAdminController::class);
    Route::resource('seats', App\Http\Controllers\Admin\SeatAdminController::class);
    Route::resource('showtimes', App\Http\Controllers\Admin\ShowtimeAdminController::class);
    Route::resource('bookings', App\Http\Controllers\Admin\BookingAdminController::class);
    Route::post('/bookings/{id}/confirm', [App\Http\Controllers\Admin\BookingAdminController::class, 'confirm'])->name('bookings.confirm');
    Route::post('bookings/{id}/confirm-payment', [App\Http\Controllers\Admin\BookingAdminController::class, 'confirmPayment'])->name('bookings.confirm-payment');
    Route::resource('payments', App\Http\Controllers\Admin\PaymentAdminController::class);
});

Route::get('/admin/password', [App\Http\Controllers\Admin\AdminAuthController::class, 'showChangePasswordForm'])->name('admin.password.form');
Route::post('/admin/password', [App\Http\Controllers\Admin\AdminAuthController::class, 'changePassword'])->name('admin.password.change');

require __DIR__.'/auth.php';
