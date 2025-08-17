<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CareersController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('careers.index', compact('categories'));
    }
}