<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\CategoryController;

Route::resource('categories', CategoryController::class);


Route::get('/', function () {
    return view('home');
});


Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/products', 'admin.products')->name('admin.products');
    Route::view('/orders', 'admin.orders')->name('admin.orders');
    Route::view('/addproduct', 'admin.products.addproduct')->name('admin.product');
    Route::view('/editproduct', 'admin.products.editproduct')->name('admin.product');

    // Use resource route for CategoryController
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);
});





Route::get('/about', function () {
    return view('about');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/products',[ProductController::class,'index']);

Route::get('/singleproduct', function () {
    return view('singleproduct');
});

Route::get('/checkout', function () {
    return view('checkout');
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

