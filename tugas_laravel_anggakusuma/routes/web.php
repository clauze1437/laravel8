<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('layouts.beranda');
});

Route::get('/beranda', function () {
    return view('layouts.beranda');
});

Route::get('/about', function () {
    return view('layouts.about');
});

Route::resource('/buku',BukuController::class);
Route::resource('/anggota',AnggotaController::class);