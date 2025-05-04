<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderController as ControllersOrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesRequestController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/contact-us', [PagesController::class, 'contactUs'])->name('contact-us');
Route::get('/banners', [BannerController::class, 'showBanners'])->name('banners.show');

Route::get('/viewproduct/{id}', [PagesController::class, 'viewproduct'])->name('viewproduct');
Route::get('/categoryproduct/{id}', [PagesController::class, 'categoryproduct'])->name('categoryproduct');
Route::get('/search', [PagesController::class, 'search'])->name('search');


Route::get('register',[RegisteredUserController::class,'create'])->name('register');
Route::post('register',[RegisteredUserController::class,'store']);




Route::middleware(['auth'])->group(function () {
    Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('mycart', [CartController::class, 'mycart'])->name('mycart');
    Route::get('cart/{id}/destroy', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('checkout/{cartid}', [PagesController::class, 'checkout'])->name('checkout');
    Route::get('order/{cartid}/store', [OrderController::class, 'store'])->name('order.store');
    Route::post('order/store', [OrderController::class, 'storecod'])->name('order.storecod');

    //order history

    Route::get('/user/orders', [OrderController::class, 'userOrders'])->middleware('auth')->name('user.orders');




});

// authentication routes
Route::middleware('auth')->group(function (){

Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class,'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');

});





//user request
 Route::middleware('auth')->group(function () {

 Route::get('/productrequest/create', [ProductRequestController::class, 'create'])->name('productrequest.create');
 Route::post('/productrequest/store', [ProductRequestController::class, 'store'])->name('productrequest.store');
});

// admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/products', [AdminController::class, 'index'])->name('admin.index');
 // Update route name to 'admin.request.approve'
 Route::patch('/product/request/{id}/approve', [AdminController::class, 'approve'])->name('admin.request.approve');
 Route::patch('/product/request/{id}/reject', [AdminController::class, 'reject'])->name('admin.request.reject');
 Route::get('/admin/products/pending', [AdminController::class, 'pendingRequests'])->name('admin.products.pending');
});






Route::middleware(['auth', 'admin'])->group(function () {

    //category
   Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
   Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');


    //products
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');



//banner
    Route::get('/banner', [BannerController::class, 'index'])->name('banner.index');
    Route::get('/banner/create', [BannerController::class, 'create'])->name('banner.create');
    Route::post('/banner/store', [BannerController::class, 'store'])->name('banner.store');
    Route::get('/banner/{id}/edit', [BannerController::class, 'edit'])->name('banner.edit');
    Route::put('/banner/{id}', [BannerController::class, 'update'])->name('banner.update');
    Route::delete('/banner/{id}/destroy', [BannerController::class, 'destroy'])->name('banner.destroy');

//user
Route::get('/users',[UserController::class,'index'])->name('user.index');




    //orders
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('order/{id}/status/{status}', [OrderController::class, 'status'])->name('order.status');


});





//dashboard

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
