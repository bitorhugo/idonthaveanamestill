<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminCardController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Home\HomeCardController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Helper\AutoCompleteController;
use App\Http\Controllers\Payment\StripeController;
use App\Services\StripeCheckoutService;

/*
|---------p-----------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

/* group routes that share the same controller*/
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/home', 'index')->name('home');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::post('/admin', [AdminController::class, 'index'])->name('admin');
});

Route::controller(StripeController::class)->group(function () {
    Route::post('/checkout', [StripeController::class, 'checkout'])->name('checkout');
    Route::post('/payNow', [StripeController::class, 'payNow'])->name('payNow');
    Route::get('/paymentSuccess', [StripeController::class, 'success'])->name('paymentSuccess');
    Route::get('/paymentCanceled', [StripeController::class, 'canceled'])->name('paymentCanceled');
});

Route::resource('/admin/cards', AdminCardController::class);

Route::resource('/admin/categories', AdminCategoryController::class);

Route::resource('/admin/users', AdminUserController::class);

Route::resource('/search', HomeCardController::class)->only(['index', 'show']);

Route::resource('/cart', CartController::class)->except(['create', 'show', 'edit']);

// Listens for stripe checkout session completed events
Route::post('/stripe/webhook', [StripeCheckoutService::class, 'handleCheckoutSessionCompleted']);
// Route::controller(AutoCompleteController::class)->group(function () {
//     Route::get('/autoCompleteCards', [HomeCardController::class, 'autoCompleteCards'])->name('autoCompleteCards');
//     Route::get('/autoCompleteUsers', [HomeCardController::class, 'autoCompleteUsers'])->name('autoCompleteUsers');
//     Route::get('/autoCompleteCategories', [HomeCardController::class, 'autoCompleteCategories'])->name('autoCompleteCategories');
// });
