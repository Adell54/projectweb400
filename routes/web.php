<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\CategoryController;





// User Routes :





Route::get('/home', [ProductController::class, 'home'])->name('home.index');
Route::get('/', [ProductController::class, 'home'])->name('home.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::resource('categories', CategoryController::class);

Route::get('/about', function () {
    return view('about');
});

 Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');



// Cart/Checkout Routes:
Route::middleware(['auth'])->group(function () {

   
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');



Route::get('/checkout', function () {
    return view('checkout');
});

});





//Admin Routes :

Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/orders', 'admin.orders')->name('admin.orders');
    
    // Routes for Products
    Route::get('/products', [ProductController::class,'adminview'])->name('admin.products');
    

    Route::get('/addproduct', [ProductController::class,'create'])->name('admin.addproduct');
    Route::post('/addproduct', [ProductController::class, 'store'])->name('admin.addproduct.store'); 
    Route::get('/editproduct/{id}', [ProductController::class,'edit'])->name('admin.editproduct');
    Route::put('/editproduct/{id}', [ProductController::class,'update'])->name('admin.updateproduct');


    Route::delete('/products/delete/{id}', [CategoryController::class, 'destroy'])->name('products.destroy');
    
    // Routes for Categories
    Route::get('/categories', [CategoryController::class,'adminview'])->name('category');
    Route::get('/categories/addcategory', [CategoryController::class,'create'])->name('addcategory');
    Route::get('/categories/editcategory/{id}', [CategoryController::class, 'edit'])->name('admin.categories.editcategory');
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categories/checkProducts/{id}', [CategoryController::class, 'checkProducts'])->name('admin.categories.checkProducts');

});







// Breeze Routes:

Route::middleware('auth')->group(function () {
    Route::get('/profile/history', [ProfileController::class, 'purchasehistory'])->name('profile.history');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.delete');
});

require __DIR__.'/auth.php';

