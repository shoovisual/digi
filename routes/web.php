<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\aboutDigiController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\RecentlyViewedController;
use App\Http\Controllers\NewArrivalsController;
use App\Http\Controllers\MostPopularController;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/services'))
        ->add(Url::create('/contact'));

    return $sitemap->toResponse(request());
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/feedback', [HomeController::class, 'feedback'])->name('feedback');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/careers', [CareersController::class, 'index'])->name('careers');
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy-policy');
Route::get('/terms-conditions', [HomeController::class, 'terms'])->name('terms-conditions');

Route::get('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{category}', [ProductController::class, 'productsByCategory'])->name('categories.show');
Route::get('/api/categories', [ProductController::class, 'getCategories'])->name('api.categories');
Route::get('/api/products-by-category/{categoryId}', [ProductController::class, 'getProductsByCategory'])->name('api.products.by-category');
Route::get('/about-digi', [aboutDigiController::class, 'index'])->name('about-digi.index');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::get('/recently-viewed', [RecentlyViewedController::class, 'index'])->name('recently-viewed.index');
Route::get('/api/recently-viewed-products', [RecentlyViewedController::class, 'getProducts'])->name('api.recently-viewed.products');
Route::post('/api/increment-view-count', [ProductController::class, 'incrementViewCount'])->name('api.increment-view-count');
Route::get('/api/search', [ProductController::class, 'search'])->name('api.search');
Route::get('/new-arrivals', [NewArrivalsController::class, 'index'])->name('new-arrivals.index');
Route::get('/most-popular', [MostPopularController::class, 'index'])->name('most-popular.index');
