<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
    // return "Ini adalah Aplikasi Laravel pertama saya";
});

Route::get('/halo', function () {
    // return view('welcome');
    return "Halo ini laravel";
});

Route::get('/club', function () {
    // return view('welcome');
    return "Selamat Datang di ClubHouse 21+";
})->middleware('cekusia');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/', function () {
    return redirect('/products');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';
