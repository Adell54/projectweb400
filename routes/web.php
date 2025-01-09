<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});



Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/products', 'admin.products')->name('admin.products');
    Route::view('/categories', 'admin.categories')->name('admin.categories');
    Route::view('/orders', 'admin.orders')->name('admin.orders');
    Route::view('/addproduct', 'admin.products.addproduct')->name('admin.product');
    Route::view('/editproduct', 'admin.products.editproduct')->name('admin.product');
    Route::view('/addcategories', 'admin.categories.addcategory')->name('admin.categories');
    Route::view('/editcategories', 'admin.categories.editcategory')->name('admin.categories');
});




Route::get('/about', function () {
    return view('about');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/products', function () {
    return view('products');
});

Route::get('/singleproduct', function () {
    return view('singleproduct');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/categories', function () {
    return view('categories');
});

Route::get('/home', function () {
    return view('home');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile/history', [ProfileController::class, 'purchasehistory'])->name('profile.history');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

