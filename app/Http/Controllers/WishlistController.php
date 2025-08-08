<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Category;

class WishlistController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('wishlist.index', compact('categories'));
    }
}
