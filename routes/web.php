<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\PaymentController;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/show/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::resource('/cart', CartController::class);
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('front_product.show');

Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');


Route::post('checkout', [CheckoutController::class, 'store'])->name('store.checkout');


Route::get( 'order/{order}/pay', [PaymentController::class, 'create'])->name('orders.payments.create');
Route::post( 'order/{order}/strip/payment-intent',[PaymentController::class, 'createStripPaymentIntent'])->name('stripe.paymentIntent.create');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
