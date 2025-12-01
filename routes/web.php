<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/halo', function () {
    return "Halo ini laravel";
});

Route::get('/club', function () {
    return "Selamat Datang di ClubHouse 21+";
})->middleware('cekusia');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // PRODUCTS ROUTES - untuk semua user yang login
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // ADMIN ONLY ROUTES - tambahkan middleware role
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
});

// Temporary debug route untuk test gambar
Route::get('/debug-images', function () {
    $products = \App\Models\Product::all();
    
    echo "<h1>Debug Images</h1>";
    
    foreach ($products as $product) {
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px;'>";
        echo "<h3>Product: {$product->Name}</h3>";
        echo "<p>Image: {$product->image}</p>";
        
        if ($product->image) {
            $url = asset('storage/products/' . $product->image);
            echo "<p>URL: <a href='{$url}' target='_blank'>{$url}</a></p>";
            echo "<img src='{$url}' style='max-width: 200px; border: 1px solid red;'>";
            
            // Check file existence
            $filePath = storage_path('app/public/products/' . $product->image);
            echo "<p>File exists: " . (file_exists($filePath) ? 'YES' : 'NO') . "</p>";
            echo "<p>File path: {$filePath}</p>";
        } else {
            echo "<p>No image</p>";
        }
        
        echo "</div>";
    }
});

require __DIR__.'/auth.php';
