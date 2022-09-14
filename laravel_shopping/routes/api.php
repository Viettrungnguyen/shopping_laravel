<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('api/auth/user', function (Request $request) {
    return ['user' => $request->user()];
});
Route::post('/login', [LoginController::class, 'login']);

Route::post('/register', [LoginController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/auth-info', [LoginController::class, 'user']);

Route::prefix('admin')->middleware('is_admin')->group(function () {
    Route::get('/home', function () {
        return view('admin.home');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/create', [UserController::class, 'create']);
        Route::post('/store', [UserController::class, 'store']);
        Route::get('/edit/{slug}', [UserController::class, 'edit']);
        Route::post('/update/{id}', [UserController::class, 'update']);
        Route::delete('/delete/{id}', [UserController::class, 'delete']);
        Route::get('/search', [UserController::class, 'search']);
    });

    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/create', [CategoryController::class, 'create']);
        Route::post('/store', [CategoryController::class, 'store']);
        Route::get('/edit/{slug}', [CategoryController::class, 'edit']);
        Route::patch('/update/{id}', [CategoryController::class, 'update']);
        Route::get('/delete/{id}', [CategoryController::class, 'delete']);
    });
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/create', [ProductController::class, 'create']);
        Route::post('/store', [ProductController::class, 'store']);
        Route::get('/edit/{slug}', [ProductController::class, 'edit']);
        Route::post('/update/{id}', [ProductController::class, 'update']);
        Route::delete('/delete/{id}', [ProductController::class, 'delete']);
    });
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'profile']);
        Route::get('/edit/{id}', [UserController::class, 'editProfile']);
        Route::post('/update/{id}', [UserController::class, 'updateProfile']);
        Route::post('/change-password/{id}', [UserController::class, 'changePassword']);
    });
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/edit/{id}', [OrderController::class, 'edit']);
        Route::patch('/update/{id}', [OrderController::class, 'update']);
        Route::delete('/delete/{id}', [OrderController::class, 'delete']);
    });
});


Route::prefix('user')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/single-product/{slug}', [HomeController::class, 'singleProduct']);
    Route::get('/new-product', [HomeController::class, 'newProduct']);

    Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
    Route::get('/add-cart/{slug}', [HomeController::class, 'addCart'])->name('add.cart');
    Route::patch('/add-cart-quantity/{slug}', [HomeController::class, 'addCartQuantity'])->name('add.cart.quantity');
    Route::get('/delete-cart/{slug}', [HomeController::class, 'removeCart'])->name('remove.cart');
    Route::patch('/update/{slug}', [HomeController::class, 'updateCart'])->name('update.cart');

    Route::post('/vnpay_payment', [HomeController::class, 'vnpay_payment'])->name('vnpay_payment');
    Route::post('/cart-complete/{vnp_TxnRef}', [HomeController::class, 'cartComplete'])->name('cart-complete');
    Route::get('/my-order', [HomeController::class, 'myOrder'])->name('myOrder');

    Route::post('/create-contact', [ContactController::class, 'store']);
    Route::get('/order-product', [HomeController::class, 'orderList']);
    Route::get('/order-product/{id}', [HomeController::class, 'findNotification']);

    Route::prefix('comment')->group(function () {
        Route::get('/', [HomeController::class, 'listComment'])->name('comment.list');
        Route::post('/store', [HomeController::class, 'createComment'])->name('comment.create');
        Route::get('/edit/{slug}', [HomeController::class, 'editComment'])->name('comment.edit');
        Route::patch('/update/{id}', [HomeController::class, 'updateComment'])->name('comment.update');
        Route::get('/delete/{id}', [HomeController::class, 'deleteComment'])->name('comment.delete');
    });
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'profile']);
        Route::get('/edit/{id}', [UserController::class, 'editProfile']);
        Route::post('/update/{id}', [UserController::class, 'updateProfile']);
        Route::post('/change-password/{id}', [UserController::class, 'changePassword']);
    });
});
