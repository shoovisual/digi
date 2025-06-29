<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $bannerImage = [
            [
                'title' => 'Enjoy the Best in Every Pixel',
                'subtitle' => 'With our affordable UHD Smart TV',
                'image' => 'https://images.unsplash.com/photo-1593784991095-a205069470b6?auto=format&fit=crop&w=1920&q=80',
            ],
            [
                'title' => 'Enjoy the Best in Every Pixel',
                'subtitle' => 'With our affordable UHD Smart TV',
                'image' => 'https://images.unsplash.com/photo-1593784991095-a205069470b6?auto=format&fit=crop&w=1920&q=80',
            ],
            [
                'title' => 'Enjoy the Best in Every Pixel',
                'subtitle' => 'With our affordable UHD Smart TV',
                'image' => 'https://images.unsplash.com/photo-1593784991095-a205069470b6?auto=format&fit=crop&w=1920&q=80',
            ],
        ];

        $learning = [
            [
                'title' => 'Our New 43” Smart TV',
                'subtitle' => 'Introducing Our UHD Smart TV',
                'description' => 'Presenting Our 43” UHD Smart TV with WebOS inside',
                'image' => 'images/fridge.jpg',
            ],
            [
                'title' => 'Our New 43” Smart TV',
                'subtitle' => 'Introducing Our UHD Smart TV',
                'description' => 'Presenting Our 43” UHD Smart TV with WebOS inside',
                'image' => 'images/washing.jpg',
            ],
            [
                'title' => 'Our New 43” Smart TV',
                'subtitle' => 'Introducing Our UHD Smart TV',
                'description' => 'Presenting Our 43” UHD Smart TV with WebOS inside',
                'image' => 'images/livingroom.jpg',
            ],
        ];
        $products = Product::take(5)->get(); // Fetch 5 products
        return view('home', compact('products', 'bannerImage', 'learning'));
    }
}
