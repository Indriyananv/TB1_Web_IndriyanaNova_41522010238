<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produk', function () {
    return view('produk');
});

//Route::get('/', function () {
    //return view('home');
//});

Route::get('/halaman', [HomeController::class, 'TampilHome']);
Route::get('/produk', [ProdukController::class, 'ViewProduk']);
Route::get('/produk/add', [ProdukController::class, 'ViewAddProduk']);
Route::post('/produk/add', [ProdukController::class, 'CreateProduk']);


Route::delete('/produk/delete/{kode_produk}', [ProdukController::class, 'DeleteProduk']);
Route::get('/produk/edit/{kode_produk}', [ProdukController::class, 'ViewEditProduk']);
Route::put('/produk/edit/{kode_produk}', [ProdukController::class, 'UpdateProduk']);
