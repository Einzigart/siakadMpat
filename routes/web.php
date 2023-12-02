<?php

use App\Http\Controllers\MKController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
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

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard-mahasiswa', function () {
    return view('dashboard-mahasiswa');
});

Route::get('/site/input-nilai-mahasiswa',[DosenController::class,'showMatkul']);
Route::get('/site/input-nilai-mahasiswa/{kode_mk}',[DosenController::class,'inputNilai']);

Route::get('/site/lihat-nilai/{nim_nip}', [MKController::class,'getNilaiMK']);
Route::get('/site/ambil-mk/{nim_nip}',[MKController::class,'listAmbilMK']);
Route::get('/site/ambil-mk/{nim_nip}/{kode_mk}',[MKController::class,'deleteMK']);
Route::post('/site/ambil-mk',[MKController::class,'tambahMK']);


Route::get('/dashboard-dosen', function () {
    return view('dashboard-dosen');
});
Route::get('/dashboard-admin', function () {
    return view('dashboard-admin');
});
Route::get('/site/daftar-mahasiswa', [MahasiswaController::class, 'show']);
Route::get('/site/daftar-dosen', [DosenController::class, 'show']);
Route::get('/site/daftar-mk-tayang', [MKController::class, 'show']);

Route::post('/site', [AuthController::class, 'login']);

Route::get('/site', function () {
    return session()->has("nim_nip")? view('dashboard'): redirect('/');
});
