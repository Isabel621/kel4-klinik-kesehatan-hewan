<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\DoctorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('page.beranda');
});

//Guest
// Fitur price
Route::get('/userprice', [App\Http\Controllers\PriceController::class, 'index']);

// Fitur doctor
Route::get('/userdoctor', [App\Http\Controllers\DoctorController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    // Fitur price
    Route::get('/price', [App\Http\Controllers\PriceController::class, 'index']);
    Route::get('/price/tambah', [App\Http\Controllers\PriceController::class, 'create']);
    Route::get('/price/edit/{id}', [App\Http\Controllers\PriceController::class, 'edit']);
    Route::post('/price/simpan', [App\Http\Controllers\PriceController::class, 'simpan']);
    Route::delete('/price/hapus/{id}', [App\Http\Controllers\PriceController::class, 'hapus']);

    // Fitur docter
    Route::get('/doctor', [App\Http\Controllers\DoctorController::class, 'index']);
    Route::get('/doctor/tambah', [App\Http\Controllers\DoctorController::class, 'create']);
    Route::get('/doctor/edit/{id}', [App\Http\Controllers\DoctorController::class, 'edit']);
    Route::post('/doctor/simpan', [App\Http\Controllers\DoctorController::class, 'simpan']);
    Route::delete('/doctor/hapus/{id}', [App\Http\Controllers\DoctorController::class, 'hapus']);
});
