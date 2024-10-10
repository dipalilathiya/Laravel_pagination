<?php
use App\Http\Controllers\admincontroller;
use Illuminate\Support\Facades\Route;

Route::any('/form', [admincontroller::class,'register'])->name('reg');
Route::any('/{id}', [admincontroller::class,'delete'])->name('delete');
Route::any('/update/{id}', [admincontroller::class,'update'])->name('update');
Route::any('/reg/logout', [admincontroller::class,'logout'])->name('logout');
Route::any('/reg/login', [admincontroller::class,'login'])->name('login');
Route::get('/reg/viewdata', [admincontroller::class,'viewdata'])->name('view');

