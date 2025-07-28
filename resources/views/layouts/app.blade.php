<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @yield('meta')
        <meta property="og:url" content="https://digi.com">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Digi">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Digi - Your One-Stop Shop for Digital Appliances">
        <meta name="twitter:description" content="Explore our extensive range of digital appliances and electronics. From UHD Smart TVs to washing machines, find everything you need at Digi.">
        <meta name="twitter:image" content="https://digi.com/img/digi-logo.png">
        <meta name="twitter:url" content="https://digi.com">
        <meta name="twitter:site" content="Digi">
        <meta name="twitter:creator" content="Digi">
        <meta name="twitter:domain" content="digi.com">
        <meta name="twitter:label1" content="Written by">
        <meta name="twitter:data1" content="Digi">
        <meta name="twitter:label2" content="Time to read">
        <meta name="twitter:data2" content="5 minutes">
        <meta name="robots" content="index, follow">
        <title>@yield('title') | {{ config('app.name') ? config('app.name') : '' }}</title>
        <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
        <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ asset('img/favicon.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @include('layouts.navbar')
        @if (!request()->is('/'))
            <div class="breadcrumb bg-white border border-[#d6eefc] px-6 py-4">
                <ul class="flex items-center font-medium breadcrumb-links text-[13px] sm:text-[14px]">
                    <li><a href="/" class="text-digi-orange">Home</a></li>

                    @php
                        $link = url('/');
                    @endphp

                    @for($i = 1; $i <= count(Request::segments()); $i++)
                        @php
                            $link .= '/' . Request::segment($i);
                        @endphp

                        &nbsp; &nbsp;<i class="bi bi-chevron-right text-digi-orange"></i>&nbsp; &nbsp;
                        <li>
                            <a href="{{ $link }}" class="text-gray-400">
                                {{ str_replace('-', ' ', ucfirst(Request::segment($i))) }}
                            </a>
                        </li>
                    @endfor
                </ul>
            </div>
        @endif


        @yield('content')
        @include('shopping.sections.where-to-buy')
        @include('layouts.footer')
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    </body>
</html>
