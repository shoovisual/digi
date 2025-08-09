@extends('layouts.app')
@section('meta')
    <meta name="description" content="Discover the latest in digital appliances and electronics at Digi. Shop our wide range of products including TVs, washing machines, refrigerators, and more. Enjoy unbeatable prices and quality service.">
    <meta name="keywords" content="Digi, digital appliances, electronics, UHD Smart TV, washing machines, refrigerators, gas cookers, air conditioners, online shopping">
    <meta property="og:description" content="Discover the latest in digital appliances and electronics at Digi. Shop our wide range of products including TVs, washing machines, refrigerators, and more. Enjoy unbeatable prices and quality service.">
    <meta property="og:keywords" content="digi, digital appliances, umejipata, tv za bei rahisi, electronics, UHD Smart TV, washing machines, refrigerators, gas cookers, air conditioners, online shopping">
    <meta property="og:image" content="{{ asset('img/favicon.png') }}">
@endsection
@section('title', 'Home')

@section('content')

    @include('sections.hero-section')

    <div class="w-full bg-[#F2F0EC] border-b border-gray-400">
        @include('shopping.sections.product-categories')
    </div>

    @include('shopping.sections.most-shopped')

    @include('sections.banner-slider')

    @include('sections.learn')

    @include('sections.need-help')


    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
@endsection
