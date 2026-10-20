<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

// Akses Tamu / Belum Login
Route::middleware('guest')->group(function () {
    Route::get('/', function () { return redirect('/login'); });
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Akses Terproteksi Middleware Auth
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Resource route memetakan otomatis ke method CRUD controller hasil flag -a
    Route::resource('departments', DepartmentController::class);
    Route::resource('employees', EmployeeController::class);
});
Auth::routes(['login' => false, 'logout' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
