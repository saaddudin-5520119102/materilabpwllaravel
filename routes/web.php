<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');

Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'index'])
    ->name('admin.home')
    ->middleware('is_admin');

Route::get('/admin/books', [App\Http\Controllers\AdminController::class, 'books'])
    ->name('admin.books')
    ->middleware('is_admin');

Route::post('admin/books', [App\Http\Controllers\AdminController::class, 'submit_book'])
    ->name('admin.book.submit')
    ->middleware('is_admin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::patch('admin/books/update', [App\Http\Controllers\AdminController::class, 'update_book'])
    ->name('admin.book.update')
    ->middleware('is_admin');

Route::get('admin/ajaxadmin/dataBuku/{id}', [App\Http\Controllers\AdminController::class, 'getDataBuku']);

Route::delete('admin/books/delete', [App\Http\Controllers\AdminController::class, 'delete_book'])
    ->name('admin.book.delete')
    ->middleware('is_admin');
