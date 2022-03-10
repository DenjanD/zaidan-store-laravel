<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\DashboardSettingController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CategoryController as AdminCategory;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\ProductController as AdminProduct;
use App\Http\Controllers\Admin\ProductPhotoController as AdminProductPhoto;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/debug-sentry', function () {
//     throw new Exception('My first Sentry error!');
// });

//Buyer Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'detail'])->name('categories-detail');
Route::get('/details/{id}', [DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [DetailController::class, 'add'])->name('detail-add');

Route::get('/checkout/callback', [CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('/success', [CartController::class, 'success'])->name('success');

//Auth Routes
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register/success', [RegisterController::class, 'success'])->name('register-success');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart-delete');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');

    //Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/dashboard/products', [DashboardProductController::class, 'index'])->name('dashboard-product');
    Route::get('/dashboard/products/create', [DashboardProductController::class, 'create'])->name('dashboard-products-create');
    Route::post('/dashboard/products', [DashboardProductController::class, 'store'])->name('dashboard-products-store');
    Route::post('/dashboard/products/{id}', [DashboardProductController::class, 'update'])->name('dashboard-products-update');
    Route::get('/dashboard/products/{id}', [DashboardProductController::class, 'detail'])->name('dashboard-products-details');
    Route::post('/dashboard/products/photos/upload', [DashboardProductController::class, 'uploadPhotos'])->name('dashboard-products-photos-upload');
    Route::get('/dashboard/products/photos/delete/{id}', [DashboardProductController::class, 'deletePhotos'])->name('dashboard-products-photos-delete');

    
    Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard-transactions');
    Route::get('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'details'])->name('dashboard-transactions-details');
    Route::post('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'update'])->name('dashboard-transactions-update');
    
    Route::get('/dashboard/settings', [DashboardSettingController::class, 'store'])->name('dashboard-settings-store');
    
    Route::get('/dashboard/account', [DashboardSettingController::class, 'account'])->name('dashboard-settings-account');
    Route::post('/dashboard/account/{redirect}', [DashboardSettingController::class, 'update'])->name('dashboard-settings-redirect');
});

//Admin Routes
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth','admin'])
    ->group(function() {
        Route::get('/', [AdminDashboard::class, 'index'])->name('admin-dashboard');
        Route::resource('category', '\App\Http\Controllers\Admin\CategoryController');
        Route::resource('user', '\App\Http\Controllers\Admin\UserController');
        Route::resource('product', '\App\Http\Controllers\Admin\ProductController');
        Route::resource('product-photo', '\App\Http\Controllers\Admin\ProductPhotoController');
    });

Auth::routes();