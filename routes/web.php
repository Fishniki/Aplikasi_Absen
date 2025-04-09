<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DataAbsensiController;
use App\Http\Controllers\admin\DataSiswaController;
use App\Http\Controllers\admin\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\AbsenController;
use App\Http\Controllers\user\DashboarController;
use App\Http\Controllers\user\LoginController;
use App\Http\Controllers\user\ProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// route untuk halaman login
Route::get('/admin/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/data-siswa', [DataSiswaController::class, 'index'])->name('admin.data-siswa');

Route::get('/admin/form-siswa', [SiswaController::class, 'index'])->name('admin.form-siswa');
Route::post('/admin/store-siswa', [SiswaController::class, 'create'])->name('admin.store-siswa');
Route::get('/admin/edit-siswa/{id}', [SiswaController::class, 'edit'])->name('admin.edit-siswa');
Route::post('/admin/update-siswa/{id}', [SiswaController::class, 'saveChanges'])->name('admin.update-siswa');
Route::get('/admin/delete-datasiswa/{id}', [SiswaController::class, 'delete'])->name('admin.delete-siswa');

Route::get('/admin/absen-siswa', [DataAbsensiController::class, 'index'])->name('admin.absen-siswa');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
});

// route untuk user
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboarController::class, 'index'])->name('dashboard');
    Route::get('/user/profile/{id}', [ProfilController::class, 'index'])->name('user.profile');
    Route::get('/user/profile-edit/{id}', [ProfilController::class, 'edit'])->name('user.profile-edit');
    Route::post('/user/profile-update/{id}', [ProfilController::class, 'saveChanges'])->name('user.profile-update');

    Route::get('/user/absen', [AbsenController::class, 'index'])->name('user.absen');
    Route::post('/user/upload-absen', [AbsenController::class, 'createAbsen'])->name('user.upload-absen');
});











// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
