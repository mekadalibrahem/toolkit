<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth' , 'verified'
])->group(function(){

    Route::name('profile.')->group(function(){
        Route::get('/profile' , [ProfileController::class , 'create'])->name('create');
        Route::post('/profile' , [ProfileController::class , 'update'])->name('update');
        Route::delete('/profile' , [ ProfileController::class , 'destroy' ])->name('destroy');
        Route::post('/change-password' , [ProfileController::class , 'change_password'])->name('change-password');
    });
});
require __DIR__.'/web/auth.php';
