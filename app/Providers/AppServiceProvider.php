<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Promotion;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share promotion visibility for navbar: show only active; otherwise show upcoming or stay tuned
        View::composer('layouts.navbar', function ($view) {
            $now = now();

            // Active promotion: within start/end date window
            $activePromotion = Promotion::query()
                ->whereNotNull('start_date')
                ->where('start_date', '<=', $now)
                ->where(function ($q) use ($now) {
                    $q->whereNull('end_date')
                      ->orWhere('end_date', '>=', $now);
                })
                ->orderByDesc('start_date')
                ->orderByDesc('created_at')
                ->first();

            // Upcoming promotion: scheduled to start in the future
            $upcomingPromotion = null;
            if (!$activePromotion) {
                $upcomingPromotion = Promotion::query()
                    ->whereNotNull('start_date')
                    ->where('start_date', '>', $now)
                    ->orderBy('start_date')
                    ->orderByDesc('created_at')
                    ->first();
            }

            $view->with('activePromotion', $activePromotion);
            $view->with('upcomingPromotion', $upcomingPromotion);
        });
    }
}
