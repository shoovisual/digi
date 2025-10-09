<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Category;

class PromotionPublicController extends Controller
{
    /**
     * Display a public promotional page with hero cover and product cards.
     */
    public function show(Promotion $promotion)
    {
        // Only allow viewing active promotions (within start/end window)
        $now = now();
        $startsOk = $promotion->start_date && $promotion->start_date->lte($now);
        $endsOk = !$promotion->end_date || $promotion->end_date->gte($now);
        if (!($startsOk && $endsOk)) {
            abort(404);
        }

        // Load related products with category relation for product card
        $promotion->load(['products.categoryRelation']);

        // Categories for navbar and filters sections
        $categories = Category::all();

        return view('shopping.promotion', [
            'promotion' => $promotion,
            'categories' => $categories,
        ]);
    }
}