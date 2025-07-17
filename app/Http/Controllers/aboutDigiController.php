<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class aboutDigiController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('about-digi.index', compact('categories'));
    }
}
