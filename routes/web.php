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
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Admin\HeroSlideController as AdminHeroSlideController;
use App\Http\Controllers\Admin\PromotionController as AdminPromotionController;
use App\Http\Controllers\PromotionPublicController;
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
Route::get('/return-policy', [HomeController::class, 'returns'])->name('return-policy');

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
Route::post('/api/increment-contact-sales', [ProductController::class, 'incrementContactSales'])->name('api.increment-contact-sales');
Route::get('/api/search', [ProductController::class, 'search'])->name('api.search');
Route::get('/new-arrivals', [NewArrivalsController::class, 'index'])->name('new-arrivals.index');
Route::get('/most-popular', [MostPopularController::class, 'index'])->name('most-popular.index');
// Public Promotion Page
Route::get('/promotions/{promotion:slug}', [PromotionPublicController::class, 'show'])->name('promotions.public.show');

// Admin Panel
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        // Admin Dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Products
        Route::resource('products', AdminProductController::class)->names([
            'index' => 'products.index',
            'create' => 'products.create',
            'store' => 'products.store',
            'show' => 'products.show',
            'edit' => 'products.edit',
            'update' => 'products.update',
            'destroy' => 'products.destroy',
        ]);

        // Product media deletion endpoints (AJAX)
        Route::post('/products/{product}/images/delete', [AdminProductController::class, 'deleteImage'])
            ->name('products.images.delete');
        Route::post('/products/{product}/gallery/delete', [AdminProductController::class, 'deleteGallery'])
            ->name('products.gallery.delete');

        // Hero Slides
        Route::resource('hero-slides', AdminHeroSlideController::class)->names([
            'index' => 'hero-slides.index',
            'create' => 'hero-slides.create',
            'store' => 'hero-slides.store',
            'show' => 'hero-slides.show',
            'edit' => 'hero-slides.edit',
            'update' => 'hero-slides.update',
            'destroy' => 'hero-slides.destroy',
        ]);

        // Categories
        Route::resource('categories', AdminCategoryController::class)
            ->only(['index','create','store','show','edit','update','destroy'])
            ->names([
                'index' => 'categories.index',
                'create' => 'categories.create',
                'store' => 'categories.store',
                'show' => 'categories.show',
                'edit' => 'categories.edit',
                'update' => 'categories.update',
                'destroy' => 'categories.destroy',
            ]);

        // Settings
        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');

        // Promotions
        Route::resource('promotions', AdminPromotionController::class)
            ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
            ->names([
                'index' => 'promotions.index',
                'create' => 'promotions.create',
                'store' => 'promotions.store',
                'show' => 'promotions.show',
                'edit' => 'promotions.edit',
                'update' => 'promotions.update',
                'destroy' => 'promotions.destroy',
            ]);
    });
});
