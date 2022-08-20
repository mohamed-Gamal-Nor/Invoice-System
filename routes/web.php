<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSectionController;
use App\Http\Controllers\ShippingAreaController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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


Auth::routes(['verify' => true, 'register' => false]);
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::group(['middleware' => ['auth','verified']], function() {
    // Dashboard Routes
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    // Roles Routes
    Route::resource('roles', RoleController::class);
    // Users Routes
    Route::get('/users/profileEdit/{id}', [UserController::class, 'profileEdit']);
    Route::put('/users/{id}/updateProfile', [UserController::class, 'updateProfile'])->name('users.updateProfile');
    Route::resource('users', UserController::class);
    // Product Section Routes
    Route::resource('productSection', ProductSectionController::class);
    // Product Routes
    Route::resource('product', ProductController::class);
    // Shipping area Routes
    Route::resource('shippingArea', ShippingAreaController::class);
    // Shipping Routes
    Route::resource('shipping', ShippingController::class);
    // supplier Routes
    Route::resource('supplier', SupplierController::class);
    // customer Routes
    Route::resource('customer', CustomerController::class);
});
Route::get('/{page}', [AdminController::class,'index']);


