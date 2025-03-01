<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\ProductDetailsPage;
use App\Livewire\ProductsPage;
use Illuminate\Support\Facades\Route;

Route::get('/', Homepage::class)->name('home');
Route::get('/products', ProductsPage::class)->name('products');
Route::get('/products/{slug}', ProductDetailsPage::class);
Route::get('/cart', \App\Livewire\CartPage::class);

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class);
    Route::get('/forgot', ForgotPassword::class)->name('password.request');
    Route::get('/reset/{token}', ResetPassword::class)->name('password.reset');
});
Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect('/');
    });
    Route::get('/checkout', CheckoutPage::class);
    Route::get('/success', \App\Livewire\SuccessPage::class)->name('success');


});
