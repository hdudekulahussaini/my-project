<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;



Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/product/{slug}', [FrontendController::class, 'productDetails'])->name('product.details');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/login', [AuthController::class, 'showLoginSelection'])->name('login');
Route::get('/login/{type}', [AuthController::class, 'showLogin'])->name('login.type')->where('type', 'user|admin');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user-dashboard', [FrontendController::class, 'userDashboard'])->name('user-dashboard');
    Route::get('/orders', [FrontendController::class, 'orders'])->name('orders');
    Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
    Route::post('/cart/add/{product}', [FrontendController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/move-to-wishlist/{cart}', [FrontendController::class, 'moveCartToWishlist'])->name('cart.move.to.wishlist');
    Route::post('/cart/{cart}/increase', [FrontendController::class, 'increaseCartQuantity'])->name('cart.increase');
    Route::post('/cart/{cart}/decrease', [FrontendController::class, 'decreaseCartQuantity'])->name('cart.decrease');
    Route::delete('/cart/{cart}', [FrontendController::class, 'deleteCart'])->name('cart.delete');
    Route::get('/wishlist', [FrontendController::class, 'wishlist'])->name('wishlist');
    Route::post('/wishlist/add/{product}', [FrontendController::class, 'addToWishlist'])->name('wishlist.add');
    Route::post('/wishlist/move-to-cart/{wishlist}', [FrontendController::class, 'moveWishlistToCart'])->name('wishlist.move.to.cart');
    Route::delete('/wishlist/{wishlist}', [FrontendController::class, 'deleteWishlist'])->name('wishlist.delete');
    Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/store', [FrontendController::class, 'storeOrder'])->name('order.store');
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});
