<?php

use App\Livewire\HomePage;
use App\Livewire\ProductsPage;
use Illuminate\Support\Facades\Route;

Route::get('/', Homepage::class)->name('home');
Route::get('/products', ProductsPage::class)->name('products');
