<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

Route::resource('produto', ProductController::class)
    ->middleware(['auth', 'only-sellers'])
    ->except(['index', 'show']);
Route::get('/produto/{product}', [ProductController::class, 'show'])->name('produto.show');

Route::middleware('auth')->group(function () {
    Route::view('/stripe/setup', 'setup-stripe')->name('stripe.setup');
    Route::post('/stripe/redirect', [StripeController::class, 'redirect'])->name('stripe.redirect');
    Route::get('/stripe/callback', [StripeController::class, 'callback'])->name('stripe.callback');
    Route::get('/stripe/dashboard', [StripeController::class, 'dashboard'])->name('stripe.dashboard');
});



require __DIR__ . '/auth.php';
