<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StripeController;

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

Route::get('/', HomeController::class)->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/produto/criar', [ProductController::class, 'create'])->middleware('only-sellers')->name('produto.create');
    Route::post('/produto', [ProductController::class, 'store'])->middleware('only-sellers')->name('produto.store');
    Route::get('/produto/{product}/editar', [ProductController::class, 'edit'])->middleware('only-sellers')->name('produto.edit');
    Route::put('/produto/{product}', [ProductController::class, 'update'])->middleware('only-sellers')->name('produto.update');
    Route::delete('/produto/{product}', [ProductController::class, 'destroy'])->middleware('only-sellers')->name('produto.destroy');
    Route::post('/produto/{product}/purchase', PurchaseController::class)->name('produto.purchase');

    Route::get('/compras', OrdersController::class)->name('orders');

    Route::view('/stripe/setup', 'setup-stripe')->name('stripe.setup');
    Route::post('/stripe/redirect', [StripeController::class, 'redirect'])->name('stripe.redirect');
    Route::get('/stripe/callback', [StripeController::class, 'callback'])->name('stripe.callback');
    Route::get('/stripe/dashboard', [StripeController::class, 'dashboard'])->name('stripe.dashboard');
});

Route::get('/produto/{product}', [ProductController::class, 'show'])->name('produto.show');


require __DIR__ . '/auth.php';
