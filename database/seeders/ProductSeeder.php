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
            'slug' => 'smart-tv-55-inch-uhd',
            'image' => 'products/tvs/55/tv-01.png',
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
                '4K UHD Resolution – Stunning clarity & lifelike details',
                'WebOS – Smooth and user-friendly interface',
                'Dolby Audio – Immersive cinematic sound',
                'Frameless Design – Sleek and modern look',
                'Built-in Apps – Netflix, YouTube, Prime Video, Disney+',
                'Game Optimiser – Enhanced gaming performance',
                '2-Year Warranty – Peace of mind guaranteed',
            ]),
            'product_images' => json_encode([
                'products/tvs/55/tv-01.png',
                'products/tvs/55/tv-02.png',
                'products/tvs/55/tv-03.png',
                'products/tvs/55/tv-04.png',
            ]),
        ]);

        Product::create([
            'name' => 'Smart TV 43-inch Smart',
            'slug' => 'smart-tv-43-inch-smart',
            'image' => 'products/tvs/43-smart/tv-02.png',
            'product_short' => 'DIGI TV 43 Frameless Smart TV',
            'serial' => 'HSDJAS4350B',
            'description' => 'Experience stunning High resolution with vibrant colors and incredible detail.',
            'category_id' => Category::where('name', 'TVs')->first()->id,
            'specifications' => json_encode([
                'resolution' => 'Full HD',
                'screen_size' => '43 inches',
                'smart_features' => true,
                'hdmi_ports' => 3,
                'usb_ports' => 2,
            ]),
            'features' => json_encode([
                '43” Smart TV – Smart, Sleek, and Powerful!',
                'FHD Resolution – Crisp and clear visuals',
                'Android OS – Smooth and user-friendly',
                'Wi-Fi Built-in – Stream seamlessly',
                'Frameless Design – Modern and stylish ',
                'Netflix & YouTube – Entertainment at your fingertips',
                '2-Year Warranty – Peace of mind',

            ]),
            'product_images' => json_encode([
                'products/tvs/43-smart/tv-02.png',
                'products/tvs/43-smart/tv-01.png',
                'products/tvs/43-smart/tv-03.png',
                'products/tvs/43-smart/tv-04.png',
            ]),
        ]);

        Product::create([
            'name' => 'TV 43-inch LED',
            'slug' => 'tv-43-inch-led',
            'image' => 'products/tvs/43-led/tv-04.png',
            'product_short' => 'DIGI TV 43 Frameless LED TV',
            'serial' => 'HBDJAS4340B',
            'description' => 'Experience stunning High resolution with vibrant colors and incredible detail.',
            'category_id' => Category::where('name', 'TVs')->first()->id,
            'specifications' => json_encode([
                'resolution' => 'Full HD',
                'screen_size' => '43 inches',
                'smart_features' => false,
                'hdmi_ports' => 3,
                'usb_ports' => 2,
            ]),
            'features' => json_encode([
                '43” LED TV – Stunning visuals and vibrant colors',
                'A+ Panel – Superior picture quality',
                'Frameless Design – Sleek and modern look',
                'Dynamic Contrast – Enhanced viewing experience',
                'Built-in Receiver – No need for external devices',
                'HDMI & USB – Multimedia connectivity',
                '2-Year Warranty – Peace of mind guaranteed',
            ]),
            'product_images' => json_encode([
                'products/tvs/43-led/tv-04.png',
                'products/tvs/43-led/tv-01.png',
                'products/tvs/43-led/tv-02.png',
                'products/tvs/43-led/tv-03.png',
            ]),
        ]);

        Product::create([
            'name' => 'TV 32-inch LED',
            'slug' => 'tv-32-inch-led',
            'image' => 'products/tvs/32/tv-03.png',
            'product_short' => 'DIGI TV 32 Frameless LED TV',
            'serial' => 'HBDJAS3240B',
            'description' => 'Experience stunning High resolution with vibrant colors and incredible detail.',
            'category_id' => Category::where('name', 'TVs')->first()->id,
            'specifications' => json_encode([
                'resolution' => 'HD',
                'screen_size' => '32 inches',
                'smart_features' => false,
                'hdmi_ports' => 3,
                'usb_ports' => 2,
            ]),
            'features' => json_encode([
                '32” LED TV – Stunning visuals and vibrant colors',
                'A+ Panel – Superior picture quality',
                'Frameless Design – Sleek and modern look',
                'AC & DC Supply – Versatile power options',
                'Built-in Receiver – No need for external devices',
                'HDMI & USB – Multimedia connectivity',
                '2-Year Warranty – Peace of mind guaranteed',
            ]),
            'product_images' => json_encode([
                'products/tvs/32/tv-03.png',
                'products/tvs/32/tv-01.png',
                'products/tvs/32/tv-02.png',
                'products/tvs/32/tv-04.png',
            ]),
        ]);

        Product::create([
            'name' => 'Washing Machine 8kg',
            'slug' => 'washing-machine-8kg',
            'product_short' => 'DIGI Washing Machine 8kg',
            'serial' => 'TTSKAB440W',
            'description' => 'Efficient and quiet washing machine with multiple programs for all fabric types.',
            'category_id' => Category::where('name', 'Washing Machine')->first()->id,
            'image' => 'products/washing-machine/wm-8.png',
            'specifications' => json_encode([
                'capacity' => '8 kg',
                'spin_speed' => '1400 RPM',
                'energy_rating' => 'A+++',
                'water_consumption' => '50 L per cycle',
            ]),
            'features' => json_encode([
                'Twin Tub Washing Machine',
                'High-efficiency motor',
                'Durable plastic body',
                'Elegant white design',
                '2-Year Warranty',
                'Wash Capacity : 8 kg',
                'Spin Capacity: 7 kg',
                'Dimension (W x D x H): 855 x 490 x 968',
            ]),
            'product_images' => json_encode([
                'products/washing-machine/wm-8.png',
                'products/washing-machine/wm-8-2.png',
                'products/washing-machine/wm-8-3.png',
            ]),
        ]);

        Product::create([
            'name' => 'Washing Machine 10kg',
            'slug' => 'washing-machine-10kg',
            'product_short' => 'DIGI Washing Machine 10kg',
            'serial' => 'TTSKAB640W',
            'description' => 'Efficient and quiet washing machine with multiple programs for all fabric types.',
            'category_id' => Category::where('name', 'Washing Machine')->first()->id,
            'image' => 'products/washing-machine/wm-10.png',
            'specifications' => json_encode([
                'capacity' => '10 kg',
                'spin_speed' => '1400 RPM',
                'energy_rating' => 'A+++',
                'water_consumption' => '60 L per cycle',
            ]),
            'features' => json_encode([
                'Twin Tub Washing Machine',
                'High-efficiency motor',
                'Durable plastic body',
                'Elegant white design',
                '2-Year Warranty',
                'Wash Capacity : 10 kg',
                'Spin Capacity: 7 kg',
                'Dimension (W x D x H): 876 x 510 x 1017',
            ]),
            'product_images' => json_encode([
                'products/washing-machine/wm-10.png',
                'products/washing-machine/wm-10-2.png',
                'products/washing-machine/wm-10-3.png',
            ]),
        ]);

        Product::create([
            'name' => 'Washing Machine 12kg',
            'slug' => 'washing-machine-12kg',
            'product_short' => 'DIGI Washing Machine 12kg',
            'serial' => 'TTSKAB740W',
            'description' => 'Efficient and quiet washing machine with multiple programs for all fabric types.',
            'category_id' => Category::where('name', 'Washing Machine')->first()->id,
            'image' => 'products/washing-machine/wm-12.png',
            'specifications' => json_encode([
                'capacity' => '12 kg',
                'spin_speed' => '1400 RPM',
                'energy_rating' => 'A+++',
                'water_consumption' => '70 L per cycle',
            ]),
            'features' => json_encode([
                'Twin Tub Washing Machine',
                'High-efficiency motor',
                'Durable plastic body',
                'Elegant white design',
                '2-Year Warranty',
                'Wash Capacity : 12 kg',
                'Spin Capacity: 7 kg',
                'Dimension (W x D x H): 947 x 537 x 1067',
            ]),
            'product_images' => json_encode([
                'products/washing-machine/wm-12.png',
                'products/washing-machine/wm-12-2.png',
                'products/washing-machine/wm-12-3.png',
            ]),
        ]);

        Product::create([
            'name' => 'Refrigerator 128L',
            'slug' => 'refrigerator-128l',
            'product_short' => 'DIGI Refrigerator 128L',
            'serial' => 'TD2HAB126S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerator')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB126S/close.png',
            'specifications' => json_encode([
                'capacity' => '128 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Top Freezer',
                'Frost Type',
                'Fast Cooling ',
                'Longer Freshness',
                'Inox Color',
                'Strong Tempered Glass Shelves ',
                '5-Year Compressor Warranty ',
                'Gross Capacity: 128 L',
                'Net Capacity : 126 L',
                'Lock & Key',
                'LED Light',
                'Dimension (W x D x H): 480 x 510 x 1130',
            ]),
            'product_images' => json_encode([
                'products/fridges/DG-RF-TD2HAB126S/close.png',
                'products/fridges/DG-RF-TD2HAB126S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'Refrigerator 151L',
            'slug' => 'refrigerator-151l',
            'product_short' => 'DIGI Refrigerator 151L',
            'serial' => 'TD2HAB222S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerator')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB222S/close.png',
            'specifications' => json_encode([
                'capacity' => '151 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Top Freezer',
                'Frost Type',
                'Fast Cooling ',
                'Longer Freshness',
                'Inox Color',
                'Strong Tempered Glass Shelves ',
                '5-Year Compressor Warranty ',
                'Gross Capacity: 159 L',
                'Net Capacity : 151 L',
                'Lock & Key',
                'LED Light',
                'Dimension (W x D x H): 500 x 580 x 1220',

            ]),
            'product_images' => json_encode([
                'products/fridges/DG-RF-TD2HAB222S/close.png',
                'products/fridges/DG-RF-TD2HAB222S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'Refrigerator 182L',
            'slug' => 'refrigerator-182l',
            'product_short' => 'DIGI Refrigerator 182L',
            'serial' => 'TD2HAB228S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerator')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB228S/close.png',
            'specifications' => json_encode([
                'capacity' => '182 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Top Freezer',
                'Frost Type',
                'Fast Cooling ',
                'Longer Freshness',
                'Inox Color',
                'Strong Tempered Glass Shelves ',
                '5-Year Compressor Warranty ',
                'Gross Capacity: 187 L',
                'Net Capacity : 182 L',
                'Tempered Shelves Glass',
                'Lock & Key',
                'LED Light',
                'Dimension (W x D x H): 500 x 580 x 1370',
            ]),
            'product_images' => json_encode([
                'products/fridges/DG-RF-TD2HAB228S/close.png',
                'products/fridges/DG-RF-TD2HAB228S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'Refrigerator 205L',
            'slug' => 'refrigerator-205l',
            'product_short' => 'DIGI Refrigerator 205L',
            'serial' => 'TD2HAB322S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerator')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB322S/close.png',
            'specifications' => json_encode([
                'capacity' => '205 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Top Freezer',
                'Frost Type',
                'Fast Cooling ',
                'Longer Freshness',
                'Inox Color',
                'Strong Tempered Glass Shelves ',
                '5-Year Compressor Warranty ',
                'Gross Capacity: 208 L',
                'Net Capacity : 205 L',
                'Tempered Shelves Glass',
                'Lock & Key',
                'LED Light',
                'Dimension (W x D x H): 550 x 560 x 1430',
            ]),
            'product_images' => json_encode([
                'products/fridges/DG-RF-TD2HAB322S/close.png',
                'products/fridges/DG-RF-TD2HAB322S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'Refrigerator 248L',
            'slug' => 'refrigerator-248l',
            'product_short' => 'DIGI Refrigerator 248L',
            'serial' => 'TD2HAB412S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerator')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB412S/close.png',
            'specifications' => json_encode([
                'capacity' => '248 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Top Freezer',
                'Frost Type',
                'Fast Cooling ',
                'Longer Freshness',
                'Inox Color',
                'Strong Tempered Glass Shelves ',
                '5-Year Compressor Warranty ',
                'Gross Capacity: 252 L',
                'Net Capacity : 248 L',
                'Tempered Shelves Glass',
                'Lock & Key',
                'LED Light',
                'Dimension (W x D x H): 550 x 580 x 1660',
            ]),
            'product_images' => json_encode([
                'products/fridges/DG-RF-TD2HAB412S/close.png',
                'products/fridges/DG-RF-TD2HAB412S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'Refrigerator 204L',
            'slug' => 'refrigerator-204l',
            'product_short' => 'DIGI Refrigerator 204L',
            'serial' => 'CF2HAB374S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerator')->first()->id,
            'image' => 'products/fridges/DG-RF-CF2HAB374S/close.png',
            'specifications' => json_encode([
                'capacity' => '204 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Bottom Freezer',
                'Frost Type',
                'Fast Cooling ',
                'Longer Freshness',
                'Inox Color',
                'Strong Tempered Glass Shelves ',
                '5-Year Compressor Warranty ',
                'Gross Capacity: 215 L',
                'Net Capacity : 204 L',
                'Tempered Shelves Glass',
                'Lock & Key',
                'LED Light',
                'Dimension (W x D x H): 550 x 570 x 1510',
            ]),
            'product_images' => json_encode([
                'products/fridges/DG-RF-CF2HAB374S/close.png',
                'products/fridges/DG-RF-CF2HAB374S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI InverterCool Pro 18K – Smart Temp Control, Hidden Display, 3m Pipe Kit, 2025',
            'slug' => 'invertercool-pro-18k',
            'product_short' => 'DIGI Smart Air Conditioner 18,000 BTU',
            'serial' => 'AC1.5T123456',
            'description' => 'Energy-efficient air conditioner with smart features for optimal cooling.',
            'category_id' => Category::where('name', 'Air Conditioner')->first()->id,
            'image' => 'products/ac/1.png',
            'specifications' => json_encode([
                'capacity' => '18,000 BTU',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                '18 K BTU:',
                'Inverter Compressor™',
                'Warranty on compressor',
                'Energy saving ',
                'Faster Cooling',
                'Low noise level',
                'Precise temperature control',
                'Simple and Modern Design with Hidden display',
                '3m refrigerant pipes +  electric cable',
                'W:910   D:294   H:206'
            ]),
            'product_images' => json_encode([
                'products/ac/1.png',
                'products/ac/2.png',
                'products/ac/3.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI InverterCool Pro 12K – Smart Temp Control, Hidden Display, 3m Pipe Kit, 2025',
            'slug' => 'invertercool-pro-12k',
            'product_short' => 'DIGI Smart Air Conditioner 12,000 BTU',
            'serial' => 'IR4TABS1250W',
            'description' => 'Energy-efficient air conditioner with smart features for optimal cooling.',
            'category_id' => Category::where('name', 'Air Conditioner')->first()->id,
            'image' => 'products/ac/4.png',
            'specifications' => json_encode([
                'capacity' => '12,000 BTU',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                '12 K BTU:',
                'Inverter Compressor™',
                'Warranty on compressor',
                'Energy saving ',
                'Faster Cooling',
                'Low noise level',
                'Precise temperature control',
                'Simple and Modern Design with Hidden display',
                '3m refrigerant pipes +  electric cable',
                'W:777    D:250    H:201 ',
            ]),
            'product_images' => json_encode([
                'products/ac/4.png',
                'products/ac/2.png',
                'products/ac/3.png',
            ]),
        ]);

        Product::create([
            'name' => '50x50 cm  Gas Cooker 4 Burner (Black)',
            'slug' => 'gas-cooker-50x50-black',
            'product_short' => 'DIGI Smart Gas Cooker 4 Burner (Black)',
            'serial' => 'EMKABF550B',
            'description' => 'High-efficiency gas cooker with 4 burners and smart features.',
            'category_id' => Category::where('name', 'Gas Cooker')->first()->id,
            'image' => 'products/gas-cooker/DIGI-DG-GC-EMKABF550B-50x50_siyah.png',
        ]);

        Product::create([
            'name' => '50x50 cm  Gas Cooker 4 Burner (Inox)',
            'slug' => 'gas-cooker-50x50-inox',
            'product_short' => 'DIGI Smart Gas Cooker 4 Burner (Inox)',
            'serial' => 'EMKABF552S',
            'description' => 'High-efficiency gas cooker with 4 burners and smart features.',
            'category_id' => Category::where('name', 'Gas Cooker')->first()->id,
            'image' => 'products/gas-cooker/DIGI-DG-GC-EMKABF552S-50x50_inox.png',
        ]);

        Product::create([
            'name' => '60x60 cm  Gas Cooker 4 Burner (Black)',
            'slug' => 'gas-cooker-60x60-black',
            'product_short' => 'DIGI Smart Gas Cooker 4 Burner (Black)',
            'serial' => 'EMKABF651B',
            'description' => 'High-efficiency gas cooker with 4 burners and smart features.',
            'category_id' => Category::where('name', 'Gas Cooker')->first()->id,
            'image' => 'products/gas-cooker/DIGI-DG-GC-EMKABF651B-60x60_siyah.png',
        ]);

        Product::create([
            'name' => '60x60 cm  Gas Cooker 4 Burner (Inox)',
            'slug' => 'gas-cooker-60x60-inox',
            'product_short' => 'DIGI Smart Gas Cooker 4 Burner (Inox)',
            'serial' => 'EMKABF650S',
            'description' => 'High-efficiency gas cooker with 4 burners and smart features.',
            'category_id' => Category::where('name', 'Gas Cooker')->first()->id,
            'image' => 'products/gas-cooker/DIGI-DG-GC-EMKABF650S-60x60_inox.png',
        ]);
    }
}
