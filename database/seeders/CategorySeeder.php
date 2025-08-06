<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'All Products',
                'slug' => 'all-products',
                'description' => 'All electronic products',
                'cover_image' => 'products/products-cover.webp',
                'cover_image_2' => 'products/fridges/fridge-cover-2.webp',
                'cover_image_3' => 'products/fridges/fridge-cover-3.webp',
                'cover_image_4' => 'products/fridges/fridge-cover-4.webp',
                'icon' => 'products/category/all.svg'
            ],

            [
                'name' => 'TVs',
                'slug' => 'digi-tvs',
                'description' => 'Discover the latest in TV technology',
                'cover_image' => 'products/category/tv-cover.png',
                'icon' => 'products/category/tvs.svg',
                'meta_description' => 'Discover affordable Digi TVs with clear HD picture, strong sound, and smart features perfect for home entertainment in Tanzania.',
                'meta_keywords' => 'Digi TV, bei nafuu TV, smart TV Tanzania, flat screen tv, runinga ya kisasa, TV ya HD, tv nzuri kwa familia, cheap TV Dar es Salaam'
            ],

            [
                'name' => 'Refrigerators',
                'slug' => 'digi-refrigerators',
                'description' => 'Keep your food fresh with our range of refrigerators',
                'cover_image' => 'products/fridges/fridge-cover-3.webp',
                'cover_image_2' => 'products/fridges/fridge-cover-2.webp',
                'cover_image_3' => 'products/fridges/fridge-cover.webp',
                'icon' => 'products/category/refrigerator.svg',
                'meta_description' => 'Keep your food fresh with Digi fridges. Affordable, energy-saving, and stylish for the modern Tanzanian kitchen.',
                'meta_keywords' => 'Digi fridge, friji ya bei poa, energy saving fridge, friji ya kisasa, single door fridge, double door fridge Tanzania, friji bora nyumbani, best fridge in Tanzania, friji ya kutumia umeme mdogo',
            ],

            [
                'name' => 'Freezers',
                'slug' => 'digi-freezers',
                'description' => 'Explore our selection of freezers for all your storage needs',
                'cover_image' => 'products/freezers/freezer-cover-2.webp',
                'icon' => 'products/category/freezers.svg',
                'meta_description' => 'Store meat, drinks, and more with Digi freezers. Reliable cooling, low power use, and designed for home or small business.',
                'meta_keywords' => 'Digi freezer, deep freezer Tanzania, freezer ya nyumbani, chest freezer bei nafuu, food storage freezer, biashara ndogo freezer, freezer ya duka',
            ],

            [
                'name' => 'Air Conditioner',
                'slug' => 'digi-acs',
                'description' => 'Stay cool with our range of air conditioners',
                'cover_image' => 'products/ac/ac-cover.webp',
                'icon' => 'products/category/acs.svg',
                'meta_description' => 'Beat the heat with Digi air conditioners. Affordable, energy-efficient cooling solutions for your home or office in Tanzania.',
                'meta_keywords' => 'Digi AC, aircon Tanzania, mashine ya baridi, split AC bei poa, AC ya chumba, AC ya ofisini, air conditioner ya kisasa, baridi nyumbani',
            ],

            [
                'name' => 'Gas Cookers',
                'slug' => 'digi-gas-cookers',
                'cover_image' => 'products/gas-cooker/gas-cooker-cover-3.webp',
                'icon' => 'products/category/gas-cooker.svg',
                'description' => ' Cook delicious meals with Digi gas cookers — safe, durable, and suitable for daily family use at home.',
                'meta_description' => 'Cook faster and save energy with Digi gas cookers. Affordable, reliable, and perfect for Tanzanian kitchens.',
                'meta_keywords' => 'Digi gas cooker, jiko la gesi, gas cooker, gas cooker bei nafuu, gas cooker zinazodumu, gas cooker ya kisasa, jiko bora Tanzania',
            ],

            [
                'name' => 'Washing Machine',
                'slug' => 'digi-washing-machine',
                'description' => 'Efficient washing machines for all your laundry needs',
                'cover_image' => 'products/washing-machine/washing-machine-cover-3.webp',
                'cover_image_2' => 'products/washing-machine/washing-machine-cover-2.webp',
                'cover_image_3' => 'products/washing-machine/washing-machine-cover.webp',
                'icon' => 'products/category/washing-machine.svg',
                'meta_description' => 'Make laundry easy with Digi washing machines. Strong, affordable, and ideal for everyday use in Tanzanian households.',
                'meta_keywords' => 'Digi washing machine, mashine ya kufulia, bei nafuu washing machine, washing machine ya kisasa, washing machine bora Tanzania',
            ],

        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
