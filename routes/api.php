<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetugasController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\GaleryController;
use App\Http\Controllers\Api\FotoController;
use App\Http\Controllers\Api\ProfileController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('petugas', PetugasController::class);
    Route::apiResource('kategori', KategoriController::class);
    Route::apiResource('posts', PostsController::class);
    Route::apiResource('galery', GaleryController::class);
    Route::apiResource('foto', FotoController::class);
    Route::apiResource('profile', ProfileController::class);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
