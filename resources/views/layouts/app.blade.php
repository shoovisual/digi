<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') | {{ config('app.name') ? config('app.name') : '' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
