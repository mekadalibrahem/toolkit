<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterUserControlelr;
use Illuminate\Support\Facades\Route ;

Route::middleware('guest')->group(function(){
    Route::get('register' ,[ RegisterUserControlelr::class , 'create'])->name('register');

    Route::post('register' , [RegisterUserControlelr::class , 'store']);


    Route::get('/login' , [AuthenticatedSessionController::class , 'create'])->name('login');
    Route::get('/login_handler' , [AuthenticatedSessionController::class , 'store'])->name('login_handler');
});



Route::get('/logout' , [AuthenticatedSessionController::class , 'destroy'])->name('logout_handler');
Route::middleware('auth' )->group(function(){
    Route::view('/dashboard' , 'user.dashboard')->name('dashboard');
});
