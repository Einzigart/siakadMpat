<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard-mahasiswa', function () {
    return view('dashboard-mahasiswa');
});
Route::get('/dashboard-dosen', function () {
    return view('dashboard-dosen');
});
Route::get('/dashboard-admin', function () {
    return view('dashboard-admin');
});
Route::get('daftar-mahasiswa',[MahasiswaController::class , 'show']);

Route::post('/login',[AuthController::class , 'login']);
