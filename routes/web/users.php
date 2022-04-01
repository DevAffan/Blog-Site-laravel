<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function(){

Route::put('/user/{user}/update' , [UserController::class , 'update'])->name('user.profile.update');
Route::get('/user/{user}/edit' , [UserController::class , 'edit'])->name('user.profile.edit');
Route::delete('/user/{user}/destroy' , [UserController::class , 'destroy'])->name('user.destroy');


Route::middleware('role:admin')->group(function(){
    Route::get('/users' , [UserController::class , 'index'])->name('users.index');

});

Route::middleware('can:view,user')->group(function(){
    Route::get('/user/{user}/profile' , [UserController::class , 'show'])->name('user.profile.show');
    Route::put('/user/{user}/attach' , [UserController::class , 'attach'])->name('user.role.attach');
    Route::put('/user/{user}/detach' , [UserController::class , 'detach'])->name('user.role.detach');
});



});

