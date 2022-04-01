<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();



Route::get('/post/{id}' , [ PostController::class , 'show' ])->name('postshow');

Route::middleware('auth')->group(function(){

Route::get('/posts' , [PostController::class , 'index'])->name('post.index');
Route::get('/post/create' , [PostController::class , 'create'])->name('post.create');
Route::get('/post/{id}/edit' , [PostController::class , 'edit'])->name('post.edit');
Route::post('/post' , [PostController::class , 'store'])->name('post.store');
Route::delete('/destroy/{id}' , [PostController::class , 'destroy'])->name('post.destroy');
Route::put('/update/{id}' , [PostController::class , 'update'])->name('post.update');


});
