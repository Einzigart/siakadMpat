<?php

use App\Http\Controllers\MKController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrintController;
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

Route::get('/site/input-nilai-mahasiswa', [DosenController::class, 'showMatkul']);
Route::get('/site/input-nilai-mahasiswa/{kode_mk}', [DosenController::class, 'inputNilai']);
Route::post('/site/lihat-input-nilai/{kode_mk}', [DosenController::class, 'saveInputNilai']);


//CRUD MK Ambil

Route::get('/site/lihat-nilai/nilai_pdf/{nim}',[PrintController::class ,'printNilaiMhs']);
Route::get('/site/lihat-nilai/{nim_nip}', [MKController::class, 'getNilaiMK']);
Route::get('/site/ambil-mk/{nim_nip}', [MKController::class, 'listAmbilMK']);
Route::get('/site/ambil-mk/{nim_nip}/{kode_mk}', [MKController::class, 'deleteMK']);
Route::post('/site/ambil-mk', [MKController::class, 'tambahMK']);

//CRUD MK Tayang
Route::get('/site/daftar-mk-tayang', [MKController::class, 'show']);
Route::get('/site/daftar-mk-tayang/delete/{kode_mk}', [MKController::class, 'delete']);
Route::post('/site/daftar-mk-tayang/tambah', [MKController::class, 'tambah']);
Route::post('/site/daftar-mk-tayang/update/{id}', [MKController::class, 'update']);
Route::get('/site/daftar-mk-tayang/update/{kode_mk}', [MKController::class, 'editShow']);

//CRUD Dosen
Route::get('/site/daftar-dosen', [DosenController::class, 'show']);
Route::get('/site/daftar-dosen/delete/{nip}', [DosenController::class, 'delete']);
Route::post('/site/daftar-dosen/tambah', [DosenController::class, 'tambah']);
Route::post('/site/daftar-dosen/update', [DosenController::class, 'update']);
Route::get('/site/daftar-dosen/update/{nip}', [DosenController::class, 'editShow']);

//CRUD Mahasiswa
Route::get('/site/daftar-mahasiswa', [MahasiswaController::class, 'show']);
Route::get('/site/daftar-mahasiswa/delete/{nim}', [MahasiswaController::class, 'delete']);
Route::post('/site/daftar-mahasiswa/tambah', [MahasiswaController::class, 'tambah']);
Route::post('/site/daftar-mahasiswa/update', [MahasiswaController::class, 'update']);
Route::get('/site/daftar-mahasiswa/update/{nim}', [MahasiswaController::class, 'editShow']);


Route::get('/dashboard-dosen', function () {
    return view('dashboard-dosen');
});
Route::get('/dashboard-admin', function () {
    return view('dashboard-admin');
});

//PDF





Route::post('/site', [AuthController::class, 'login']);
Route::get('/site', function () {
    return session()->has("nim_nip") ? view('dashboard') : redirect('/');
});
