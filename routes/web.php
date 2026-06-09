<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\FeatureController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\AdminOrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\SearchController;


Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/product/{slug}', [FrontendController::class, 'productDetails'])->name('product.details');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/login', [AuthController::class, 'showLoginSelection'])->name('login');
Route::get('/login/user', [AuthController::class, 'showUserLogin'])->name('login.user');
Route::get('/login/admin', [AuthController::class, 'showAdminLogin'])->name('login.admin');
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
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
    
    Route::get('/address/create', [AddressController::class, 'create'])->name('address.create');
    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
    Route::get('/address/{id}/edit', [AddressController::class, 'edit'])->name('address.edit');
    Route::put('/address/{id}', [AddressController::class, 'update'])->name('address.update');
    Route::delete('/address/{id}', [AddressController::class, 'destroy'])->name('address.destroy');
    Route::get('/live-search', [SearchController::class, 'liveSearch'])->name('live.search');
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

    Route::get('/features', [FeatureController::class, 'index'])->name('features.index');
    Route::get('/features/create', [FeatureController::class, 'create'])->name('features.create');
    Route::post('/features/store', [FeatureController::class, 'store'])->name('features.store');
    Route::get('/features/{feature}/edit', [FeatureController::class, 'edit'])->name('features.edit');
    Route::put('/features/{feature}', [FeatureController::class, 'update'])->name('features.update');
    Route::delete('/features/{feature}', [FeatureController::class, 'destroy'])->name('features.destroy');
    // Orders
    // Orders
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/admin/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
});
