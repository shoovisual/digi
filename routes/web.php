<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\aboutDigiController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{category}', [ProductController::class, 'productsByCategory'])->name('categories.show');
Route::get('/about-digi', [aboutDigiController::class, 'index'])->name('about-digi.index');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
