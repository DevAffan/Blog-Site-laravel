<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;




Route::get('/roles', [RoleController::class , 'index'])->name('users.roles.index');
Route::put('/role/create', [RoleController::class , 'store'])->name('users.roles.store');
Route::post('/role/{role}/edit', [RoleController::class , 'edit'])->name('users.roles.edit');
Route::delete('/role/{id}/delete', [RoleController::class , 'destroy'])->name('users.roles.destroy');

