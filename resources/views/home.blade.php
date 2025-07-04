@extends('layouts.app')
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
