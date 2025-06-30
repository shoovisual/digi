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
            'serial' => 'TTSKAB440W',
            'description' => 'Efficient and quiet washing machine with multiple programs for all fabric types.',
            'category_id' => Category::where('name', 'Washing Machine')->first()->id,
            'image' => 'products/washing-machine/wm-8.png',
        ]);

        Product::create([
            'name' => 'Washing Machine 10kg',
            'product_short' => 'DIGI Washing Machine 10kg',
            'serial' => 'TTSKAB640W',
            'description' => 'Efficient and quiet washing machine with multiple programs for all fabric types.',
            'category_id' => Category::where('name', 'Washing Machine')->first()->id,
            'image' => 'products/washing-machine/wm-10.png',
        ]);

        Product::create([
            'name' => 'Washing Machine 12kg',
            'product_short' => 'DIGI Washing Machine 12kg',
            'serial' => 'TTSKAB740W',
            'description' => 'Efficient and quiet washing machine with multiple programs for all fabric types.',
            'category_id' => Category::where('name', 'Washing Machine')->first()->id,
            'image' => 'products/washing-machine/wm-12.png',
        ]);

        Product::create([
            'name' => 'Refrigerator 400L',
            'product_short' => 'DIGI Smart Refrigerator 400L',
            'serial' => 'CF2HAB374S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerator')->first()->id,
            'image' => 'products/fridges/DG-RF-CF2HAB374S/close.png',
        ]);

        Product::create([
            'name' => 'Refrigerator 400L',
            'product_short' => 'DIGI Smart Refrigerator 400L',
            'serial' => 'TD2HAB222S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerator')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB222S/close.png',
        ]);

        Product::create([
            'name' => 'Refrigerator 400L',
            'product_short' => 'DIGI Smart Refrigerator 400L',
            'serial' => 'TD2HAB126S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerator')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB126S/close.png',
        ]);

        Product::create([
            'name' => 'Refrigerator 400L',
            'product_short' => 'DIGI Smart Refrigerator 400L',
            'serial' => 'TD2HAB228S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerator')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB228S/close.png',
        ]);

        Product::create([
            'name' => 'Refrigerator 400L',
            'product_short' => 'DIGI Smart Refrigerator 400L',
            'serial' => 'TD2HAB322S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerator')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB322S/close.png',
        ]);

        Product::create([
            'name' => 'Refrigerator 400L',
            'product_short' => 'DIGI Smart Refrigerator 400L',
            'serial' => 'TD2HAB412S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerator')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB412S/close.png',
        ]);

        Product::create([
            'name' => 'air Conditioner 1.5 Ton',
            'product_short' => 'DIGI Smart Air Conditioner 1.5 Ton',
            'serial' => 'AC1.5T123456',
            'description' => 'Energy-efficient air conditioner with smart features for optimal cooling.',
            'category_id' => Category::where('name', 'Air Conditioner')->first()->id,
            'image' => 'products/ac/1.png',
        ]);

        Product::create([
            'name' => 'air Conditioner 2 Ton',
            'product_short' => 'DIGI Smart Air Conditioner 2 Ton',
            'serial' => 'AC2T123456',
            'description' => 'Energy-efficient air conditioner with smart features for optimal cooling.',
            'category_id' => Category::where('name', 'Air Conditioner')->first()->id,
            'image' => 'products/ac/2.png',
        ]);

        Product::create([
            'name' => 'air Conditioner 2 Ton',
            'product_short' => 'DIGI Smart Air Conditioner 2 Ton',
            'serial' => 'AC2T123456-2',
            'description' => 'Energy-efficient air conditioner with smart features for optimal cooling.',
            'category_id' => Category::where('name', 'Air Conditioner')->first()->id,
            'image' => 'products/ac/3.png',
        ]);

        Product::create([
            'name' => '50x50 cm  Gas Cooker 4 Burner (Black)',
            'product_short' => 'DIGI Smart Gas Cooker 4 Burner (Black)',
            'serial' => 'EMKABF550B',
            'description' => 'High-efficiency gas cooker with 4 burners and smart features.',
            'category_id' => Category::where('name', 'Gas Cooker')->first()->id,
            'image' => 'products/gas-cooker/DIGI-DG-GC-EMKABF550B-50x50_siyah.png',
        ]);

        Product::create([
            'name' => '50x50 cm  Gas Cooker 4 Burner (Inox)',
            'product_short' => 'DIGI Smart Gas Cooker 4 Burner (Inox)',
            'serial' => 'EMKABF552S',
            'description' => 'High-efficiency gas cooker with 4 burners and smart features.',
            'category_id' => Category::where('name', 'Gas Cooker')->first()->id,
            'image' => 'products/gas-cooker/DIGI-DG-GC-EMKABF552S-50x50_inox.png',
        ]);

        Product::create([
            'name' => '60x60 cm  Gas Cooker 4 Burner (Black)',
            'product_short' => 'DIGI Smart Gas Cooker 4 Burner (Black)',
            'serial' => 'EMKABF651B',
            'description' => 'High-efficiency gas cooker with 4 burners and smart features.',
            'category_id' => Category::where('name', 'Gas Cooker')->first()->id,
            'image' => 'products/gas-cooker/DIGI-DG-GC-EMKABF651B-60x60_siyah.png',
        ]);

        Product::create([
            'name' => '60x60 cm  Gas Cooker 4 Burner (Inox)',
            'product_short' => 'DIGI Smart Gas Cooker 4 Burner (Inox)',
            'serial' => 'EMKABF650S',
            'description' => 'High-efficiency gas cooker with 4 burners and smart features.',
            'category_id' => Category::where('name', 'Gas Cooker')->first()->id,
            'image' => 'products/gas-cooker/DIGI-DG-GC-EMKABF650S-60x60_inox.png',
        ]);
    }
}
