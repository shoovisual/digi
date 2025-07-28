@extends('layouts.app')
@section('meta')
<meta name="description" content="Discover the latest in digital appliances and electronics at Digi. Shop our wide range of products including TVs, washing machines, refrigerators, and more. Enjoy unbeatable prices and quality service.">
<meta name="keywords" content="Digi, digital appliances, electronics, UHD Smart TV, washing machines, refrigerators, gas cookers, air conditioners, online shopping">
<meta name="author" content="Digi">
<meta property="og:title" content="Digi - Your One-Stop Shop for Digital Appliances">
<meta property="og:description" content="Explore our extensive range of digital appliances and electronics. From UHD Smart TVs to washing machines, find everything you need at Digi.">
<meta property="og:image" content="{{ asset('img/digi-logo.svg') }}">
@endsection
@section('title', 'Home')

@section('content')

    @include('sections.hero-section')

    @include('shopping.sections.product-categories')

    @include('sections.banner-slider')

    @include('shopping.sections.most-shopped')

    @include('sections.learn')

    @include('sections.need-help')


    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
@endsection
