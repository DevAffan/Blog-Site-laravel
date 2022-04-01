<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;


Route::get('/permissions', [PermissionController::class , 'index'])->name('users.permissions.index');
Route::put('/permission/create', [PermissionController::class , 'store'])->name('users.permissions.store');
Route::post('/permission/{permission}/edit', [PermissionController::class , 'edit'])->name('users.permissions.edit');
Route::delete('/permission/{id}/delete', [PermissionController::class , 'destroy'])->name('users.permissions.destroy');


