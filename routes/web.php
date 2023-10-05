<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('2fa', [App\Http\Controllers\UserCodeController::class, 'index'])->name('2fa.index');
Route::post('2fa', [App\Http\Controllers\UserCodeController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [App\Http\Controllers\UserCodeController::class, 'resend'])->name('2fa.resend');
