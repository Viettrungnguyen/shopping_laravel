<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;
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


Route::get('/login', [LoginController::class, 'getLogin'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login.post');

Route::get('register', [LoginController::class, 'getRegister'])->name('register');
Route::post('register', [LoginController::class, 'postRegister'])->name('register.post');

Route::get('/logout', [LoginController::class, 'logOut'])->name('logout');

Route::prefix('admin')->middleware('is_admin')->group(function () {
    Route::get('/home', function () {
        return view('admin.home');
    })->name('admin.home');
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.list');
        Route::get('/create', [UserController::class, 'create'])->name('user.add');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{slug}', [UserController::class, 'edit'])->name('user.edit');
        Route::patch('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    });

    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.list');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.add');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{slug}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::patch('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });

    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.list');
        Route::get('/create', [ProductController::class, 'create'])->name('product.add');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{slug}', [ProductController::class, 'edit'])->name('product.edit');
        Route::patch('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    });

    Route::prefix('tags')->group(function () {
        Route::get('/', [TagsController::class, 'index'])->name('tags.list');
        Route::get('/create', [TagsController::class, 'create'])->name('tags.add');
        Route::post('/store', [TagsController::class, 'store'])->name('tags.store');
        Route::get('/edit/{id}', [TagsController::class, 'edit'])->name('tags.edit');
        Route::patch('/update/{id}', [TagsController::class, 'update'])->name('tags.update');
        Route::get('/delete/{id}', [TagsController::class, 'delete'])->name('tags.delete');
    });

    Route::prefix('contact')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('contact.list');
        Route::get('/create', [ContactController::class, 'create'])->name('contact.add');
        Route::post('/store', [ContactController::class, 'store'])->name('contact.store');
        Route::get('/edit/{slug}', [ContactController::class, 'edit'])->name('contact.edit');
        Route::patch('/update/{id}', [ContactController::class, 'update'])->name('contact.update');
        Route::get('/delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');
    });

    Route::get('/profile', [UserController::class, 'profile'])->name('profile1');
    Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('edit.profile1');
    Route::patch('/update-profile', [UserController::class, 'updateProfile'])->name('update.profile1');
    Route::get('/change-password', [UserController::class, 'showChangePassword'])->name('show.change.password1');
    Route::patch('/change-password', [UserController::class, 'changePassword'])->name('change.password1');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('user')->group(function () {

    Route::get('/single-product/{slug}', [HomeController::class, 'singleProduct'])->name('single-product');

    Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
    Route::get('/add-cart/{slug}', [HomeController::class, 'addCart'])->name('add.cart');
    Route::patch('/add-cart-quantity/{slug}', [HomeController::class, 'addCartQuantity'])->name('add.cart.quantity');
    Route::get('/delete-cart/{slug}', [HomeController::class, 'removeCart'])->name('remove.cart');
    Route::patch('/update/{slug}', [HomeController::class, 'updateCart'])->name('update.cart');

    Route::post('/vnpay_payment', [HomeController::class, 'vnpay_payment'])->name('vnpay_payment');
    Route::get('/cart-complete/{vnp_TxnRef}', [HomeController::class, 'cartComplete'])->name('cart-complete');
    Route::get('/my-order', [HomeController::class, 'myOrder'])->name('myOrder');

    Route::post('/create-contact', [ContactController::class, 'store'])->name('create.contact');
    Route::get('/order-product', [HomeController::class, 'orderList'])->name('order.list');
    Route::get('/order-product/{id}', [HomeController::class, 'findNotification'])->name('find.notification');

    Route::prefix('comment')->group(function () {
        Route::get('/', [HomeController::class, 'listComment'])->name('comment.list');
        Route::post('/store', [HomeController::class, 'createComment'])->name('comment.create');
        Route::get('/edit/{slug}', [HomeController::class, 'editComment'])->name('comment.edit');
        Route::patch('/update/{id}', [HomeController::class, 'updateComment'])->name('comment.update');
        Route::get('/delete/{id}', [HomeController::class, 'deleteComment'])->name('comment.delete');
    });
});

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('edit.profile');
Route::patch('/update-profile', [UserController::class, 'updateProfile'])->name('update.profile');
Route::get('/change-password', [UserController::class, 'showChangePassword'])->name('show.change.password');
Route::patch('/change-password', [UserController::class, 'changePassword'])->name('change.password');
