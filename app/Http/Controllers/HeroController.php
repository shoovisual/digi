<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeroController extends Controller
{
    /**
     * Get hero slider data
     *
     * @return array
     */
    public function getSliderData()
    {
        return [
            [
                'image'       => '/img/product-cover-umejipata.png',
                'mobileImage' => '/img/product-cover-umejipata-mobile.png',
                'tabletImage' => '/img/product-cover-umejipata-ipad.png',
                'title'       => 'Vumbua Furaha na Uhuru na DIGI',
                'subtitle'    => 'Bidhaa mahususi kwa nyumba yako',
                'primary'     => [
                    'label' => 'View Products',
                    'url'   => '/products'
                ],
                'secondary'   => [
                    'label' => 'Contact us',
                    'url'   => '/contact'
                ],
            ],
            [
                'image'       => '/img/hero-slider-1.jpg',
                'mobileImage' => '/img/product-cover-umejipata-mobile.png',
                'tabletImage' => '/img/product-cover-umejipata-ipad.png',
                'title'       => 'Teknolojia ya Kisasa kwa Nyumba Yako',
                'subtitle'    => 'Vifaa vya hali ya juu kwa maisha bora',
                'primary'     => [
                    'label' => 'Explore Now',
                    'url'   => '/products'
                ],
                'secondary'   => [
                    'label' => 'Learn More',
                    'url'   => '/about'
                ],
            ],
            [
                'image'       => '/img/tv-cover.png',
                'mobileImage' => '/img/product-cover-umejipata-mobile.png',
                'tabletImage' => '/img/product-cover-umejipata-ipad.png',
                'title'       => 'Furaha ya Familia Inaanza Hapa',
                'subtitle'    => 'Vifaa vya nyumbani vya ubora wa juu',
                'primary'     => [
                    'label' => 'Shop Now',
                    'url'   => '/products'
                ],
                'secondary'   => [
                    'label' => 'Get Support',
                    'url'   => '/contact'
                ],
            ],
        ];
    }

    /**
     * Get hero slider configuration
     *
     * @return array
     */
    public function getSliderConfig()
    {
        return [
            'autoplay'        => true,
            'autoplaySpeed'   => 5000,
            'speed'           => 1000,
            'fade'            => true,
            'arrows'          => true,
            'dots'            => true,
            'pauseOnHover'    => false,
            'pauseOnDotsHover'=> true,
            'adaptiveHeight'  => false,
            'infinite'        => true,
            'slidesToShow'    => 1,
            'slidesToScroll'  => 1,
            'cssEase'         => 'ease-in-out',
        ];
    }
}