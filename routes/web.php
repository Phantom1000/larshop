<?php

use App\Http\Controllers\ResetController;
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

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'person', 'as' => 'person.'], function () {
        Route::get('/orders', [App\Http\Controllers\Person\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [App\Http\Controllers\Person\OrderController::class, 'show'])->name('orders.show');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['is_admin']], function () {
        Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('home');
        Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::resource('categories', 'App\Http\Controllers\Admin\CategoryController');
        Route::resource('products', 'App\Http\Controllers\Admin\ProductController');
    });
});

Route::get('reset', App\Http\Controllers\ResetController::class)->name('reset');

Route::get('/', 'App\Http\Controllers\MainController@index')->name('index');
Route::get('/categories', 'App\Http\Controllers\MainController@categories')->name('categories');

Route::get('/category/{category}', 'App\Http\Controllers\MainController@category')->name('category');
Route::get('/product/{category}/{product?}', 'App\Http\Controllers\MainController@product')->name('product');



Route::group(['prefix' => 'basket'], function () {
    Route::post('/add/{product}', 'App\Http\Controllers\BasketController@basketAdd')->name('basket-add');

    Route::group(['middleware' => ['basket_not_empty']], function () {
        Route::get('/', 'App\Http\Controllers\BasketController@basket')->name('basket');
        Route::get('/place', 'App\Http\Controllers\BasketController@basketPlace')->name('basket-place');
        Route::post('/place', 'App\Http\Controllers\BasketController@basketConfirm')->name('basket-confirm');
        Route::post('/remove/{product}', 'App\Http\Controllers\BasketController@basketRemove')->name('basket-remove');
    });
});
