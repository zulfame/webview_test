<?php

use App\Http\Controllers\TestingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/contact', 'contact');

Route::prefix('testing')->group(function () {
    Route::get('upload', [TestingController::class, 'upload'])->name('testing.upload.index');
    Route::post('upload', [TestingController::class, 'upload_store'])->name('testing.upload.store');
    Route::put('upload', [TestingController::class, 'upload_update'])->name('testing.upload.update');

    Route::get('embed', [TestingController::class, 'embed'])->name('testing.embed.index');

    Route::get('webcam', [TestingController::class, 'webcam'])->name('testing.webcam.index');
    Route::post('webcam', [TestingController::class, 'webcam_post'])->name('testing.webcam.post');
});
