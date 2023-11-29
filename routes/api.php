<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\TenanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/barang', [BarangController::class, 'addBarang']);
Route::get('/get-barang', [BarangController::class, 'getBarang']);
Route::get('/get-barang/{id}', [BarangController::class, 'getBarangById']);
Route::put('/update-barang/{id}', [BarangController::class, 'updateBarang']);
Route::delete('/delete-barang/{id}', [BarangController::class, 'deleteBarang']);
Route::post('/kasir', [KasirController::class, 'addKasir']);
Route::get('/get-kasir', [KasirController::class, 'getKasir']);
Route::post('/tenan', [TenanController::class, 'addTenan']);
Route::get('/get-tenan', [TenanController::class, 'getTenan']);
Route::get('/get-tenan/{id}', [TenanController::class, 'getTenanById']);
Route::post('/nota', [NotaController::class, 'addNota']);
Route::get('/get-nota', [NotaController::class, 'getNota']);