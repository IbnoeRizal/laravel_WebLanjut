<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //untuk pilihan load, insert, update, delete
    Route::get('pilihan',function(){
        return view('components.pilihan');
    })->name('pilihan');

    // untuk tabel categories
    Route::get('categories/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::resource('categories',CategoryController::class)->except(['edit']);
    // untuk tabel products
    Route::get('products/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::resource('products', ProductController::class)->except(['edit']);;

    // untuk tabel transactions
    Route::get('transactions/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::resource('transactions', TransactionController::class)->except(['edit']);;
});

require __DIR__.'/auth.php';
