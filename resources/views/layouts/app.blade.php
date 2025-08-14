<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XD5F90NQQR"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-XD5F90NQQR');
        </script>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NCP69366');</script>
        <!-- End Google Tag Manager -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('meta')
        <meta property="og:type" content="website">
        <meta property="og:title" content="@yield('title') | {{ config('app.name') ? config('app.name') : '' }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ config('app.name') ? config('app.name') : '' }}">
        <meta property="og:type" content="website">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="@yield('title') | {{ config('app.name') ? config('app.name') : '' }}">
        <meta name="twitter:description" content="Explore our extensive range of digital appliances and electronics. From UHD Smart TVs to washing machines, find everything you need at Digi.">
        <meta name="twitter:image" content="{{ asset('img/favicon.png') }}">
        <meta name="robots" content="index, follow">
        <title>@yield('title') | {{ config('app.name') ? config('app.name') : '' }}</title>
        <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
        <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ asset('img/favicon.png') }}" type="image/png">

        @include('layouts.partials.vendor_css')
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NCP69366"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
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
        @vite('resources/js/app.js')
        @verbatim
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Organization",
                "name": "Digi Appliances",
                "url": "https://digiappliances.com",
                "logo": "https://digiappliances.com/img/digi-logo.svg"
            }
        </script>
        @endverbatim

    </body>
</html>
