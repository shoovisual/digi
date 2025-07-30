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
                'icon' => 'products/category/tvs.svg'
            ],

            [
                'name' => 'Refrigerators',
                'slug' => 'digi-refrigerators',
                'description' => 'Keep your food fresh with our range of refrigerators',
                'cover_image' => 'products/fridges/fridge-cover-3.webp',
                'cover_image_2' => 'products/fridges/fridge-cover-2.webp',
                'cover_image_3' => 'products/fridges/fridge-cover.webp',
                'icon' => 'products/category/refrigerator.svg'
            ],

            [
                'name' => 'Freezers',
                'slug' => 'digi-freezers',
                'description' => 'Explore our selection of freezers for all your storage needs',
                'cover_image' => 'products/freezers/freezer-cover-2.webp',
                'icon' => 'products/category/freezers.svg'
            ],

            [
                'name' => 'Air Conditioner',
                'slug' => 'digi-acs',
                'description' => 'Stay cool with our range of air conditioners',
                'cover_image' => 'products/ac/ac-cover.webp',
                'icon' => 'products/category/acs.svg'
            ],

            [
                'name' => 'Gas Cookers',
                'slug' => 'digi-gas-cookers',
                'cover_image' => 'products/gas-cooker/gas-cooker-cover-3.webp',
                'icon' => 'products/category/gas-cooker.svg'
            ],

            [
                'name' => 'Washing Machine',
                'slug' => 'digi-washing-machine',
                'description' => 'Efficient washing machines for all your laundry needs',
                'cover_image' => 'products/washing-machine/washing-machine-cover-3.webp',
                'cover_image_2' => 'products/washing-machine/washing-machine-cover-2.webp',
                'cover_image_3' => 'products/washing-machine/washing-machine-cover.webp',
                'icon' => 'products/category/washing-machine.svg'
            ],

        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
