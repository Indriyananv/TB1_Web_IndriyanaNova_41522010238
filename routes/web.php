<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/produk', function () {
//     return view('produk');
// });

// //Route::get('/', function () {
//     //return view('home');
// //});

Route::middleware(['auth', 'user-access:user'])->prefix('user')->group(function(){
Route::get('/halaman', [HomeController::class, 'TampilHome']);
Route::get('/produk', [ProdukController::class, 'ViewProduk']);
Route::get('/produk/add', [ProdukController::class, 'ViewAddProduk']);
Route::post('/produk/add', [ProdukController::class, 'CreateProduk']);

Route::delete('/produk/delete/{kode_produk}', [ProdukController::class, 'DeleteProduk']);
Route::get('/produk/edit/{kode_produk}', [ProdukController::class, 'ViewEditProduk']);
Route::put('/produk/edit/{kode_produk}', [ProdukController::class, 'UpdateProduk']);

Route::get('/laporan', [ProdukController::class, 'ViewLaporan']);
Route::get('/report',[ProdukController::class, 'print']);
});

Route::middleware(['auth', 'user-access:admin'])->prefix('admin')->group(function(){
    Route::get('/halaman', [HomeController::class, 'TampilHome']);
    Route::get('/produk', [ProdukController::class, 'ViewProduk']);
    Route::get('/produk/add', [ProdukController::class, 'ViewAddProduk']);
    Route::post('/produk/add', [ProdukController::class, 'CreateProduk']);

    Route::delete('/produk/delete/{kode_produk}', [ProdukController::class, 'DeleteProduk']);
    Route::get('/produk/edit/{kode_produk}', [ProdukController::class, 'ViewEditProduk']);
    Route::put('/produk/edit/{kode_produk}', [ProdukController::class, 'UpdateProduk']);

    Route::get('/laporan', [ProdukController::class, 'ViewLaporan']);
    Route::get('/report',[ProdukController::class, 'print']);
    });

Route::get(' /login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);
