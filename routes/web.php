<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', Controller::class . '@index')->name('home');
Route::get('/filterByCategory/{category}', Controller::class . '@filterByCategory')->name('category.show');
Route::get('/response', Controller::class . '@response')->name('finally_code');
Route::get('/products/{id}', ProductController::class . '@show');
Route::post('/products/add/{id}', CartController::class . '@prepareBag');
Route::post('/cart', CartController::class . '@store');
Route::post('/finally', CartController::class . '@finally')->name('finally');   
Route::get('/mycart', CartController::class . '@toCart')->name('mycart');
Route::get('/nery/client/{id}', Controller::class . '@neryShow')->name('neryShow');
Route::post('/addToCart', CartController::class . '@createCart')->name('addToCart');
Route::get('/cart/remove/{id}', CartController::class . '@removeItemCart')->name('removeFromMyCart');
Route::get('form/product/store', function () {
    return view('neryAdmin.addProduct');
})->name('product-store');
Route::post('/product/store', ProductController::class . '@store')->name('product-store-add');

//admin routes
//admin login page
Route::get('/administerNery', function () {
    return view('admin.index');
})->name('admin-cart');
//admin register page
Route::get('/administerNery/register', function () {
    return view('admin.register');
})->name('admin-register');
Route::get('/administerNery/dashboard', Controller::class . '@dash')->name('admin-register');


//routes of administer

// login route
Route::get('/administerNery/login', AuthController::class . '@login')->name('admin-login');
Route::post('/administerNery/create', AuthController::class . '@store')->name('admin-create');
Route::get('/administerNery/logout', AuthController::class . '@logout')->name('admin-logout');

//category routes
Route::get('/administerNery/category', CategoryController::class . '@index')->name('admin-category');
Route::get('/administerNery/category/create', CategoryController::class . '@create')->name('admin-category-create');
Route::post('/administerNery/category/store', CategoryController::class . '@store')->name('admin-category-store');
Route::get('/administerNery/category/edit/{id}', CategoryController::class . '@edit')->name('admin-category-edit');
Route::post('/administerNery/category/update/{id}', CategoryController::class . '@update')->name('admin-category-update');
Route::get('/administerNery/category/delete/{id}', CategoryController::class . '@destroy')->name('admin-category-delete');

//product routes

Route::get('/administerNery/product', ProductController::class . '@index')->name('admin-product');
Route::get('/administerNery/product/create', ProductController::class . '@create')->name('admin-product-create');
Route::post('/administerNery/product/store', ProductController::class . '@store')->name('admin-product-store');
Route::get('/administerNery/product/edit/{id}', ProductController::class . '@edit')->name('admin-product-edit');
Route::post('/administerNery/product/update/{id}', ProductController::class . '@update')->name('admin-product-update');
Route::get('/administerNery/product/delete/{id}', ProductController::class . '@destroy')->name('admin-product-delete');
