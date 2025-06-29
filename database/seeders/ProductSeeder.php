<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Smart TV 55-inch UHD',
            'image' => 'tv-1.png',
            'product_short' => 'DIGI TV 55 Frameless Smart TV',
            'serial' => 'HSDJAS6550B',
            'description' => 'Experience stunning 4K UHD resolution with vibrant colors and incredible detail.',
            'category_id' => Category::where('name', 'TVs')->first()->id,
            'specifications' => json_encode([
                'resolution' => '4K UHD',
                'screen_size' => '55 inches',
                'smart_features' => true,
                'hdmi_ports' => 3,
                'usb_ports' => 2,
            ]),
            'features' => json_encode([
                'α5 AI Processor 4K Gen6 with AI Brightness & 4K Upscaling',
                'Filmmaker Mode: Enjoy your Content as the Director Intended',
                'AI Sound (Virtual Surround 5.1) for an Immersive Experience',
                'Smart WebOS platform with OTT Apps like Netflix, Prime Video, Disney+ Hotstar and many more',
                'ALLM, HGIG Mode for a Better HDR Gaming Experience',
            ]),
            'product_images' => json_encode([
                'products/tvs/tv-01.png',
                'products/tvs/tv-02.png',
                'products/tvs/tv-03.png',
            ]),
        ]);

        Product::create([
            'name' => 'Washing Machine 8kg',
            'product_short' => 'DIGI Washing Machine 8kg',
            'serial' => 'WASH123456',
            'description' => 'Efficient and quiet washing machine with multiple programs for all fabric types.',
            'category_id' => Category::where('name', 'Washing Machine')->first()->id,
            'image' => 'digi-washing-machine-1.jpg',
        ]);

        Product::create([
            'name' => 'Smart Refrigerator 400L',
            'product_short' => 'DIGI Smart Refrigerator 400L',
            'serial' => 'REFRIG123456',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerator')->first()->id,
            'image' => 'cd03a8fb79-2.jpg',
        ]);

        Product::create([
            'name' => 'Laptop 15-inch Intel i7',
            'product_short' => 'DIGI Laptop 15-inch Intel i7',
            'serial' => 'LAPTOP123456',
            'description' => 'High-performance laptop for work and entertainment with a sleek design.',
            'category_id' => Category::where('name', 'Freezers')->first()->id,
            'image' => 'c7853e675d-2.jpg',
        ]);

        Product::create([
            'name' => 'Smartphone X Pro',
            'product_short' => 'DIGI Smartphone X Pro',
            'serial' => 'SMART123456',
            'description' => 'Capture stunning photos and enjoy lightning-fast performance with this flagship smartphone.',
            'category_id' => Category::where('name', 'Freezers')->first()->id,
            'image' => 'ae921e79d1-2.jpg',
        ]);
    }
}
