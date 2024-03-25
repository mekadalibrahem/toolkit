<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;

use Illuminate\Support\Facades\Route ;



Route::get('/login' , [AuthenticatedSessionController::class , 'create'])->name('login');
Route::get('/login_handler' , [AuthenticatedSessionController::class , 'store'])->name('login_handler');

Route::get('/logout' , [AuthenticatedSessionController::class , 'destroy'])->name('logout_handler');
Route::middleware('auth' )->group(function(){
    Route::view('/dashboard' , 'user.dashboard')->name('dashboard');
});
