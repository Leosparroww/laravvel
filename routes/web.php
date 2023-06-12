<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// login ,register
Route::middleware('admin')->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');

});
Route::middleware('auth')->group(function () {
    //dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashborad');
    //admin

    Route::middleware('admin')->group(function () {

        //category
        Route::group(['prefix' => 'category/'], function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('createPage', [CategoryController::class, 'createPage'])->name('create#page');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        //account
        Route::prefix('admin')->group(function () {
            // password
            Route::get('password/changePage', [AdminController::class, 'passwordChangePage'])->name('admin#passwordChangePage');
            Route::post('passwordChange', [AdminController::class, 'passwordChange'])->name('admin#passwordChange');
            //profile
            Route::get('details', [AdminController::class, 'details'])->name('admin#details');
            Route::get('edit', [AdminController::class, 'edit'])->name('admin#edit');
            Route::post('update/{id}', [AdminController::class, 'update'])->name('admin#update');
            //admin list
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            Route::get('changeRole/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}', [AdminController::class, 'change'])->name('admin#change');
        });
        //product
        Route::prefix('products')->group(function () {
            Route::get('list', [ProductController::class, 'list'])->name('product#list');
            Route::get('create', [ProductController::class, 'createPage'])->name('products#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('products#create');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('products#delete');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products#edit');
            Route::get('updatePage/{id}', [ProductController::class, 'updatePage'])->name('product#updatePage');
            Route::post('update', [ProductController::class, 'update'])->name('products#update');
        });
        //order
        Route::prefix('order')->group(function () {
            Route::get('list', [OrderController::class, 'orderList'])->name('order#list');
            Route::get('change/status', [OrderController::class, 'changeStatus'])->name('order#changeStatus');
            Route::get('ajax/change/status', [OrderController::class, 'ajaxChangeStatus'])->name('order#status');
            Route::get('listInfo/{orderCode}', [OrderController::class, 'orderListInfo'])->name('order#listInfo');
        });
        Route::prefix('user')->group(function () {
            Route::get('list', [UserController::class, 'userList'])->name('user#list');
            Route::get('change/role', [UserController::class, 'userRoleChange'])->name('user#changeRole');
            Route::get('edit/{id}', [UserController::class, 'userEdit'])->name('user#edit');
            Route::post('user/update', [UserController::class, 'userUpdate'])->name('user#update');
            Route::get('message/list', [UserController::class, 'userMessageList'])->name('user#messageList');
            Route::get('ajax/message/clear', [Usercontroller::class, 'messageClear'])->name('user#messageClear');
            Route::get('message/info/{id}', [UserController::class, 'messageInfo'])->name('user#messageInfo');
        });

    });

    //user panel
    Route::group(['prefix' => 'user', 'middleware' => 'user'], function () {
        Route::get('home', [UserController::class, 'home'])->name('user#home');
        Route::get('filter/{id}', [UserController::class, 'filter'])->name('user#filter');
        Route::get('history', [UserController::class, 'history'])->name('user#history');
        Route::get('contact', [UserController::class, 'contactUser'])->name('user#contact');
        Route::post('message', [UserController::class, 'userMessageSent'])->name('user#meassageSent');

        Route::prefix('pizza')->group(function () {
            Route::get('details/{id}', [UserController::class, 'pizzaDetails'])->name('user#pizzaDetails');
        });
        Route::prefix('cart')->group(function () {
            Route::get('list', [UserController::class, 'cartList'])->name('user#cartList');

        });

        Route::prefix('password')->group(function () {
            Route::get('change', [UserController::class, 'passwordChangePage'])->name('user#passwordChangePage');
            Route::post('change', [UserController::class, 'passwordChange'])->name('user#passwordChange');
        });
        Route::prefix('account')->group(function () {
            Route::get('change', [UserController::class, 'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}', [UserController::class, 'accountChange'])->name('user#change');
        });
        Route::prefix('ajax')->group(function () {
            Route::get('pizzaList', [AjaxController::class, 'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::get('clear/cart', [AjaxController::class, 'clearCart'])->name('ajax#clearCart');
            Route::get('clear/current/product', [AjaxController::class, 'clearCurrentProduct'])->name('ajxa#clearCurrentProduct');
            Route::get('viewcount', [AjaxController::class, 'viewcount'])->name('ajax#viewcount');
        });

    });

});
